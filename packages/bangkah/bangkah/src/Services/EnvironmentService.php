<?php

namespace Bangkah\Starter\Services;

use Illuminate\Filesystem\Filesystem;

class EnvironmentService
{
    public function __construct(private Filesystem $files = new Filesystem)
    {
    }

    /**
     * Set Nama Aplikasi di .env dan .env.example
     */
    public function setAppName(string $targetPath, string $name): void
    {
        $value = '"' . $name . '"';
        $this->updateAllEnvFiles($targetPath, 'APP_NAME', $value);
    }

    /**
     * Konfigurasi Database dan Session
     */
    public function configureDatabase(string $targetPath, string $dbType, bool $docker = false): void
    {
        $dbType = strtolower($dbType);
        $host = $docker ? 'db' : '127.0.0.1';

        // 1. Logika Penentuan Driver & Port
        if ($dbType === 'sqlite') {
            $this->setupSqlite($targetPath);
        } else {
            $isPgsql = in_array($dbType, ['postgresql', 'postgres', 'pgsql']);
            
            $config = [
                'DB_CONNECTION' => $isPgsql ? 'pgsql' : 'mysql',
                'DB_HOST'       => $host,
                'DB_PORT'       => $isPgsql ? '5432' : '3306',
                'DB_DATABASE'   => 'laravel',
                'DB_USERNAME'   => 'root',
                'DB_PASSWORD'   => '',
            ];

            foreach ($config as $key => $value) {
                $this->updateAllEnvFiles($targetPath, $key, $value);
            }
        }

        // 2. Set Session Driver ke file agar bisa langsung running tanpa migrate
        $this->updateAllEnvFiles($targetPath, 'SESSION_DRIVER', 'file');
        
        // Opsional: Set driver lain ke file/sync agar lebih ringan saat starter
        $this->updateAllEnvFiles($targetPath, 'CACHE_STORE', 'file');
        $this->updateAllEnvFiles($targetPath, 'QUEUE_CONNECTION', 'sync');
    }

    /**
     * Khusus setup SQLite
     */
    private function setupSqlite(string $targetPath): void
    {
        // Update env
        $this->updateAllEnvFiles($targetPath, 'DB_CONNECTION', 'sqlite');
        $this->updateAllEnvFiles($targetPath, 'DB_DATABASE', 'database.sqlite');
        
        // Kosongkan yang tidak perlu untuk sqlite agar .env bersih
        $this->updateAllEnvFiles($targetPath, 'DB_HOST', '');
        $this->updateAllEnvFiles($targetPath, 'DB_PORT', '');
        $this->updateAllEnvFiles($targetPath, 'DB_USERNAME', '');
        $this->updateAllEnvFiles($targetPath, 'DB_PASSWORD', '');

        // Buat file database.sqlite jika tidak ada
        $dbDir = $targetPath . '/database';
        if (!$this->files->isDirectory($dbDir)) {
            $this->files->makeDirectory($dbDir, 0755, true);
        }

        $sqlitePath = $dbDir . '/database.sqlite';
        if (!$this->files->exists($sqlitePath)) {
            $this->files->put($sqlitePath, '');
        }
    }

    /**
     * Update key di .env sekaligus .env.example
     */
    private function updateAllEnvFiles(string $targetPath, string $key, string $value): void
    {
        $this->updateEnvFile($targetPath . '/.env', $key, $value);
        $this->updateEnvFile($targetPath . '/.env.example', $key, $value);
    }

    /**
     * Core logic untuk manipulasi file .env
     */
    private function updateEnvFile(string $filePath, string $key, string $value): void
    {
        if (!$this->files->exists($filePath)) {
            return;
        }

        $content = $this->files->get($filePath);
        $pattern = "/^" . preg_quote($key, '/') . "=.*/m";
        $newLine = "{$key}={$value}";

        if (preg_match($pattern, $content)) {
            // Jika key sudah ada, ganti nilainya
            $content = preg_replace($pattern, $newLine, $content);
        } else {
            // Jika belum ada, tambahkan di baris baru
            $content = rtrim($content) . "\n" . $newLine . "\n";
        }

        $this->files->put($filePath, $content);
    }
}