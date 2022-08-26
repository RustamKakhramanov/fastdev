<?php

namespace Kraify\Fastdev;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Finder\SplFileInfo;

class FastDevServiceProvider extends ServiceProvider
{

    public function __construct($app)
    {
        $this->app = $app;

        return parent::__construct($app);
    }


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->copyFiles();
            $this->registerRoutes();
        }
    }


    protected function copyFiles()
    {
        $filesystem = new Filesystem;
        $stubs_path = __DIR__ . '/../stubs';

        collect($filesystem->directories($stubs_path))->each(function ($dir) use ($filesystem, $stubs_path) {
            $dir_name = explode('stubs', $dir)[1];

            collect($filesystem->allFiles($stubs_path . $dir_name))
                ->each(function (SplFileInfo $file) use ($filesystem, $dir_name) {
                    $path  = $file->getRelativePath();

                    if (!is_dir($directory = base_path("$dir_name/$path"))) {
                        mkdir($directory, 0755, true);
                    }

                    $filesystem->copy(
                        $file->getPathname(),
                        "$directory/" . $file->getFilename()
                    );
                });
        });
    }

    protected function registerRoutes()
    {
        file_put_contents(
            base_path('routes/api.php'),
            file_get_contents(__DIR__ . '/Routes/api'),
            FILE_APPEND
        );
    }
}
