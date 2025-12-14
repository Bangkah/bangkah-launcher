<?php

namespace App\Services\Starter;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class TemplateService
{
    public function __construct(private Filesystem $files = new Filesystem)
    {
    }

    public function applyWeb(string $targetPath): void
    {
        $this->ensureDirs($targetPath, [
            'routes',
            'resources/views',
        ]);

        // Backup existing web.php if present, then replace
        $webRoutes = $targetPath.'/routes/web.php';
        if ($this->files->exists($webRoutes)) {
            $this->files->move($webRoutes, $webRoutes.'.backup-'.date('YmdHis'));
        }
        $this->files->copy(base_path('resources/starter/web/routes/web.stub.php'), $webRoutes);

        // Copy home view
        $this->files->copy(base_path('resources/starter/web/views/home.blade.php'), $targetPath.'/resources/views/home.blade.php');
    }

    public function applyApi(string $targetPath): void
    {
        $this->ensureDirs($targetPath, [
            'routes',
            'app/Http/Controllers/Api',
        ]);

        // Backup existing api.php if present, then merge minimal route
        $apiRoutes = $targetPath.'/routes/api.php';
        $stub = $this->files->get(base_path('resources/starter/api/routes/api.stub.php'));
        if ($this->files->exists($apiRoutes)) {
            $this->files->append($apiRoutes, "\n\n".$stub."\n");
        } else {
            $this->files->put($apiRoutes, $stub);
        }

        // Create HealthController
        $controllerTarget = $targetPath.'/app/Http/Controllers/Api/HealthController.php';
        if (! $this->files->exists($controllerTarget)) {
            $this->files->copy(base_path('resources/starter/api/controllers/HealthController.stub.php'), $controllerTarget);
        }
    }

    private function ensureDirs(string $base, array $relPaths): void
    {
        foreach ($relPaths as $rel) {
            $dir = rtrim($base.'/'.trim($rel, '/'), '/');
            if (! $this->files->isDirectory($dir)) {
                $this->files->makeDirectory($dir, 0755, true);
            }
        }
    }
}
