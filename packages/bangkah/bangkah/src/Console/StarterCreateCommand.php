<?php

namespace Bangkah\Starter\Console;

use Bangkah\Starter\Services\DependencyInstaller;
use Bangkah\Starter\Services\DockerService;
use Bangkah\Starter\Services\EnvironmentService;
use Bangkah\Starter\Services\TemplateService;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class StarterCreateCommand extends Command
{
    // Tambahkan sqlite ke dalam help signature agar user tahu itu tersedia
    protected $signature = 'bangkah:create
        {--docker : Aktifkan Docker}
        {--nginx : Gunakan Nginx (hanya jika --docker)}
        {--type= : Tipe project: web|api}
        {--auth : Sertakan auth scaffolding}
        {--db= : Tipe database: mysql|postgres|sqlite}
        {--frontend= : Frontend: tailwind|bootstrap|none}
        {--yes : Auto-konfirmasi semua pilihan (non-interaktif)}';

    protected $description = 'Bangkah Interactive Starter Kit - Scaffold current Laravel project';

    public function handle(TemplateService $templates, DockerService $docker, DependencyInstaller $deps, EnvironmentService $env)
    {
        $fs = new Filesystem();
        $targetPath = base_path();
        $projectName = basename($targetPath);
        
        $this->info("Scaffolding project: {$projectName}");

        $nonInteractive = (bool) $this->option('yes')
            || $this->option('docker') || $this->option('type') || $this->option('db') || $this->option('frontend') || $this->option('auth');

        // 1. Tentukan Database Terlebih Dahulu (karena mempengaruhi opsi Docker)
        if ($this->option('db')) {
            $dbInput = strtolower($this->option('db'));
            $dbType = match($dbInput) {
                'postgres', 'pgsql', 'postgresql' => 'PostgreSQL',
                'sqlite' => 'SQLite',
                default => 'MySQL',
            };
        } elseif ($nonInteractive) {
            $dbType = 'MySQL';
        } else {
            $dbType = $this->choice('Tipe database?', ['MySQL', 'PostgreSQL', 'SQLite'], 0);
        }

        // 2. Docker Logic (SQLite biasanya tidak pakai Docker container terpisah)
        if ($dbType === 'SQLite') {
            $useDocker = false; // SQLite tidak butuh Docker DB
        } else {
            $useDocker = $nonInteractive
                ? (bool) $this->option('docker')
                : $this->confirm('Gunakan Docker?', false);
        }

        $useNginx = $useDocker
            ? ($nonInteractive ? (bool) $this->option('nginx') : $this->confirm('Gunakan Nginx?', true))
            : false;

        // 3. Project Type
        if ($this->option('type')) {
            $projectType = strtolower($this->option('type')) === 'api' ? 'API' : 'Web';
        } elseif ($nonInteractive) {
            $projectType = 'Web';
        } else {
            $projectType = $this->choice('Tipe project?', ['Web', 'API'], 0);
        }

        $includeAuth = $this->option('auth') ? true : ($nonInteractive ? false : $this->confirm('Include auth scaffolding?', false));

        // 4. Frontend
        if ($this->option('frontend')) {
            $frontend = match (strtolower($this->option('frontend'))) {
                'none' => 'None',
                'bootstrap' => 'Bootstrap',
                default => 'Tailwind',
            };
        } elseif ($nonInteractive) {
            $frontend = 'Tailwind';
        } else {
            $frontend = $this->choice('Frontend?', ['Tailwind', 'Bootstrap', 'None'], 0);
        }

        // --- Eksekusi ---

        if ($projectType === 'Web') {
            $templates->applyWeb($targetPath);
        } else {
            $templates->applyApi($targetPath);
        }

        // Panggil EnvironmentService yang sudah mendukung SQLite & Session file
        $env->setAppName($targetPath, $projectName);
        $env->configureDatabase($targetPath, $dbType, $useDocker);

        if ($useDocker) {
            $this->cleanLocalRepositories($targetPath);
            $docker->generateCompose($targetPath, [
                'nginx' => $useNginx,
                'db' => strtolower($dbType) === 'postgresql' || strtolower($dbType) === 'pgsql' || strtolower($dbType) === 'postgres' ? 'postgres' : 'mysql',
                'frontend' => $frontend,
            ]);
            $this->info('Membangun dan menjalankan container Docker...');
            $exit = $this->runProcess(['docker', 'compose', 'up', '-d', '--build'], $targetPath);
            if ($exit !== 0) {
                $this->runProcess(['docker-compose', 'up', '-d', '--build'], $targetPath);
            }
        } else {
            $this->info('Menjalankan setup lokal (composer/npm)...');
            $deps->composerInstall($targetPath);
            if (strtolower($frontend) !== 'none') {
                $deps->npmInstall($targetPath, $frontend);
            }
        }

        if ($includeAuth) {
            $this->info('Menginstall auth scaffolding...');
            $deps->installAuth($targetPath, $frontend);
        }

        $url = $this->determineUrl($useDocker, $useNginx, $projectType);
        
        $this->newLine();
        $this->components->info('Starter project berhasil dibuat!');
        $this->line('Nama: '.$projectName);
        $this->line('Jenis: '.$projectType);
        $this->line('Docker: '.($useDocker ? 'Ya' : 'Tidak').($useDocker && $useNginx ? ' + Nginx' : ''));
        $this->line('Database: '.$dbType);
        $this->line('Frontend: '.$frontend);
        $this->line('Session: File (No Migration Required)');
        $this->newLine();
        $this->components->twoColumnDetail('Buka project di', $url);

        return self::SUCCESS;
    }

    private function runProcess(array $cmd, string $cwd): int
    {
        $process = new Process($cmd, $cwd, null, null, 1800);
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });
        return $process->getExitCode() ?? 0;
    }

    private function determineUrl(bool $docker, bool $nginx, string $type): string
    {
        if ($docker) {
            return $nginx ? 'http://localhost:8080' : 'http://localhost:8000';
        }
        
        // Untuk lokal tanpa Docker, beri tahu user untuk menjalankan serve
        return 'http://localhost:8000 (Jalankan php artisan serve)';
    }

    private function cleanLocalRepositories(string $targetPath): void
    {
        $composerFile = $targetPath . '/composer.json';
        if (! file_exists($composerFile)) return;
        
        $composer = json_decode(file_get_contents($composerFile), true);
        if (! $composer) return;
        
        $modified = false;
        
        if (isset($composer['repositories'])) {
            foreach ($composer['repositories'] as $key => $repo) {
                if (is_array($repo) && isset($repo['type']) && $repo['type'] === 'path') {
                    unset($composer['repositories'][$key]);
                    $modified = true;
                }
            }
            if (empty($composer['repositories'])) {
                unset($composer['repositories']);
            } else {
                $composer['repositories'] = array_values($composer['repositories']);
            }
        }
        
        if (isset($composer['require']['bangkah/bangkah'])) {
            unset($composer['require']['bangkah/bangkah']);
            $modified = true;
        }
        
        if ($modified) {
            file_put_contents($composerFile, json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n");
            if (file_exists($targetPath . '/composer.lock')) {
                unlink($targetPath . '/composer.lock');
            }
        }
    }
}