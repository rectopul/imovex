<?php

namespace App\Providers;

use App\Models\Property;
use App\Models\WebConfiguration;
use Illuminate\Support\ServiceProvider;
use DB;
use File;
use Illuminate\Support\Facades\Cache;

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
        if(WebConfiguration::count()) {
            $webConfigurations =collect(WebConfiguration::first()->getAttributes())->filter(function($index, $attribute){
                return $attribute != 'id' && $attribute != 'created_at' && $attribute != 'updated_at';
            });
    
            config(['web' => $webConfigurations]);
        }

        
        // load all propeties in to cache and make it global
        // if(!Cache::has('properties')) {
        //     $properties = Property::all();
        //     Cache::put('properties', $properties, 1440);
        // }


        // DB::listen(function($query) {
        //     File::append(
        //         storage_path('/logs/query.log'),
        //         '[' . date('Y-m-d H:i:s') . ']' . PHP_EOL . $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL . PHP_EOL
        //     );
        // });
        
    }
}
