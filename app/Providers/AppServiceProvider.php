<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);
        try {
            $connection = DB::connection()->getPdo();
            if ($connection) {

                config(['broadcasting.default' => get_option('broadcast_default', 'null')]);
                config(['broadcasting.connections.pusher.key' => get_option('pusher_app_key', 'null')]);
                config(['broadcasting.connections.pusher.secret' => get_option('pusher_app_secret', 'null')]);
                config(['broadcasting.connections.pusher.app_id' => get_option('pusher_app_id', 'null')]);
                config(['broadcasting.connections.pusher.options.cluster' => get_option('pusher_app_cluster', 'null')]);


                View::composer('admin.common.header', function ($view) {
                    $data['adminNotifications'] = Notification::where('user_type', 1)->where('is_seen', 'no')->orderBy('created_at', 'DESC')->get();
                    $count = 0;
                    foreach ($data['adminNotifications'] as $notification) {
                        if ($notification->sender) {
                            $count++;
                        }
                    }
                    $data['totalAdminNotifications'] = $count;
                    $view->with($data);
                });
            }


        } catch (\Exception $e) {
            //
        }
    }
}
