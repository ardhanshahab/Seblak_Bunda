<?php

namespace App\Providers;

use App\Models\Config\WebConfig;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('web_configs')) {
            view()->share([
                'app_name' => WebConfig::where(['name' => 'app_name'])->first()['value'] ?? '-',
                'app_logo' => WebConfig::where(['name' => 'app_logo'])->first()['file_path'] ?? '-',
            ]);
        }
    }
}
