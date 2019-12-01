<?php

namespace HayriCan\IpChecker;

/**
 * Laravel IP Checker
 *
 * @author    Hayri Can BARÇIN <hayricanbarcin (#) gmail (.) com>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/HayriCan/laravel-ip-checker
 */

use Exception;
use HayriCan\IpChecker\Contracts\IpCheckerInterface;
use HayriCan\IpChecker\Http\Middleware\IpChecker;
use Illuminate\Support\ServiceProvider;
use HayriCan\IpChecker\DBDriver;
use HayriCan\IpChecker\FileDriver;

class IpCheckerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     * @throws Exception
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/ipchecker.php', 'ipchecker'
        );
        $this->bindServices();
    }
    public function boot()
    {
        $this->loadConfig();
        $this->loadRoutes();
        $this->loadViews();
        if (config('ipchecker.driver') === 'db'){
            $this->loadMigrations();
        }
        $this->loadTranslation();
    }

    public function bindServices(){
        $driver = config('ipchecker.driver');
        switch ($driver) {
            case 'file':
                $instance = FileDriver::class;
                break;
            case 'db':
                $instance = DBDriver::class;
                break;
            default:
                throw new Exception("Unsupported Driver");
                break;
        }
        $this->app->singleton(IpCheckerInterface::class,$instance);

        $this->app->singleton('ipchecker', function ($app) use ($instance){
            return new IpChecker($app->make($instance));
        });
    }

    public function loadConfig(){
        $this->publishes([
            __DIR__ . '/../config/ipchecker.php' => config_path('ipchecker.php')
        ], 'ipchecker');
    }

    public function loadRoutes(){
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    public function loadViews(){
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ipchecker');
    }

    public function loadMigrations(){
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    public function loadTranslation(){
        $this->loadTranslationsFrom(__DIR__ . '/lang', 'ipchecker');

        $this->publishes([
            __DIR__ . '/lang' => resource_path('lang/vendor/ipchecker'),
        ], 'ipchecker');
    }

}