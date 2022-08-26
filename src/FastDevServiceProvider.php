<?php

namespace Kraify\Fastdev;

use Illuminate\Support\ServiceProvider;


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
        $this->registerCommands();
    }

    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }
    }
}
