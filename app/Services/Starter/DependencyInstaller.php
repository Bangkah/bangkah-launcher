<?php

namespace App\Services\Starter;

use Symfony\Component\Process\Process;

class DependencyInstaller
{
    public function composerInstall(string $cwd): int
    {
        return $this->run(['composer', 'install', '--no-interaction'], $cwd);
    }

    public function npmInstall(string $cwd, string $frontend): int
    {
        $code = $this->run(['npm', 'install'], $cwd);
        if ($code !== 0) {
            return $code;
        }

        $frontend = strtolower($frontend);
        if ($frontend === 'tailwind') {
            $this->run(['npm', 'install', '-D', 'tailwindcss', 'postcss', 'autoprefixer'], $cwd);
            $this->run(['npx', 'tailwindcss', 'init', '-p'], $cwd);
        } elseif ($frontend === 'bootstrap') {
            $this->run(['npm', 'install', 'bootstrap', '@popperjs/core'], $cwd);
        }
        return 0;
    }

    public function installAuth(string $cwd, string $frontend): void
    {
        $frontend = strtolower($frontend);
        if ($frontend === 'tailwind') {
            // Breeze with Blade (Tailwind)
            $this->run(['composer', 'require', 'laravel/breeze', '--dev'], $cwd);
            $this->run(['php', 'artisan', 'breeze:install', 'blade'], $cwd);
        } elseif ($frontend === 'bootstrap') {
            // Laravel UI for Bootstrap
            $this->run(['composer', 'require', 'laravel/ui', '--dev'], $cwd);
            $this->run(['php', 'artisan', 'ui', 'bootstrap', '--auth'], $cwd);
        } else {
            // Minimal auth scaffolding can be added later if needed
        }
    }

    private function run(array $cmd, string $cwd): int
    {
        $process = new Process($cmd, $cwd, null, null, 1800);
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });
        return $process->getExitCode() ?? 0;
    }
}
