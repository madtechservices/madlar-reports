<?php

namespace Tomatophp\TomatoSauce;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

use TomatoPHP\TomatoPHP\Services\Menu\TomatoMenuRegister;
use TomatoPHP\TomatoSauce\Menus\ReportMenu;
use TomatoPHP\TomatoSauce\View\Components\ReportChartComponent;
use TomatoPHP\TomatoSauce\View\Components\ReportTableComponent;
use TomatoPHP\TomatoSauce\View\Components\ReportWidgetComponent;
use TomatoPHP\TomatoSauce\View\Components\TomatoSauceComponent;


class TomatoSauceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        TomatoMenuRegister::registerMenu(ReportMenu::class);
        //Register generate command
        $this->commands([
           \TomatoPHP\TomatoSauce\Console\TomatoSauceInstall::class,
        ]);

        Blade::component('tomato-sauce', TomatoSauceComponent::class);
        Blade::component('report-table', ReportTableComponent::class);
        Blade::component('report-widget', ReportWidgetComponent::class);
        Blade::component('report-chart', ReportChartComponent::class);

        $this->mergeConfigFrom(__DIR__.'/config/tomato-sauce.php', 'tomato-sauce');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/config/tomato-sauce.php' => config_path('report.php'),
            ], 'config');

        }
        //Register Config file
//        $this->mergeConfigFrom(__DIR__.'/config/tomato-sauce.php', 'tomato-sauce');

        //Publish Config
//        $this->publishes([
//           __DIR__.'/config/tomato-sauce.php' => config_path('tomato-sauce.php'),
//        ], 'config');

        //Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        //Publish Migrations
        $this->publishes([
           __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');
        //Register views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tomato-sauce');

        //Publish Views
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/tomato-sauce'),
        ], 'views');

        //Register Langs
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tomato-sauce');

        //Publish Lang
        $this->publishes([
           __DIR__.'/../resources/lang' => resource_path('lang/vendor/tomato-sauce'),
        ], 'lang');

        //Register Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    }

    public function boot(): void
    {
        //you boot methods here
    }
}
