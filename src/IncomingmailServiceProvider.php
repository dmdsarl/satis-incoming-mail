<?php
namespace Satis\Incomingmail;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class IncomingmailServiceProvider extends ServiceProvider{
    protected $namespace = 'App\Http\Controllers\IncomingMail';

    public function boot(){
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/config/incoming_mail.php' => config_path('incoming_mail.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/IncomingMailController.php' => app_path('Http/Controllers/IncomingMail/IncomingMailController.php'),
            ]);

            $this->commands([
                IncomingMailRegistration::class,
            ]);

        }
        $this->app->register(IncomingmailServiceProvider::class);

    }

    public function register(){
        $this->mergeConfigFrom(
            __DIR__.'/config/incoming_mail.php','incoming_mail'
        );
        $this->app->singleton(IncomingMail::class, function (){
            return new IncomingMail();
        });

    }


    public function map()
    {
        $this->mapApiRoutes();
    }

    protected function mapApiRoutes()
    {
        Route::prefix('incoming_mail_api')
            ->namespace($this->namespace)
            ->group(__DIR__.'/../../routes/api.php');
    }

}
