<?php

namespace Objectivehtml\Backup;

use Gitonomy\Git\Repository;
use Statamic\Facades\Utility;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;
use Objectivehtml\Backup\Git\Config;

class ServiceProvider extends AddonServiceProvider
{
    protected $repository;

    protected $routes = [
        'cp' => __DIR__.'/../routes/cp.php',
        // 'actions' => __DIR__.'/../routes/actions.php',
        // 'web' => __DIR__.'/../routes/web.php',
    ];
    
    /*
    protected $fieldtypes = [
        Fieldtypes\EventDate::class,
        Fieldtypes\RRule::class,
    ];

    protected $scripts = [
        __DIR__.'/../dist/cp.js',
        __DIR__.'/../dist/forms.js',
        __DIR__.'/../dist/events.js'
    ];
    
    protected $stylesheets = [
        __DIR__.'/../dist/rrule.css'
    ];
    
    protected $tags = [
        Tags\Events::class
    ];

    protected $widgets = [
        Widgets\ImportEvents::class
    ];
    */

    public function register()
    {
        parent::register();

        $this->repository = new Repository(
            config('backup.git.path', base_path())
        );

        $this->app->singleton('statamic.backup.config', function() {
            return new Config($this->repository);
        });

        $this->app->singleton('statamic.backup.repository', function() {
            return $this->repository;
        });

        $this->app->alias('statamic.backup.repository', 'statamic.backup.repo');
    }

    public function boot()
    {
        parent::boot();

        $this->publishes([
            __DIR__.'/../config/backup.php' => config_path('backup.php')
        ], 'config');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'backup');

        Utility::make('git-backup')
            ->view('backup::utility.index', function() {
                return [
                    'repository' => $this->repository
                ];
            })
            ->title('Git Backup')
            ->description('Configure Git to make remote backups of your site.')
            ->docsUrl('https://objectivehtml.com/docs/backup')
            ->icon('git')
            ->register();

            dd($this);
    }
}
