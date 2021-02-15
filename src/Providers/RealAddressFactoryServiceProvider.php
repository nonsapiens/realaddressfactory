<?php

namespace Nonsapiens\RealAddressFactory\Providers;

use Faker\Generator;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Nonsapiens\RealAddressFactory\Faker\RealAddressFactoryFaker;

/**
 * Class RealAddressFactoryServiceProvider
 * @package Nonsapiens\RealAddressFactory
 */
class RealAddressFactoryServiceProvider extends ServiceProvider
{

    /**
     * @param Request $request
     * @param Router $router
     */
    public function boot(Request $request, Router $router)
    {
        # Config file vendor publishing
        $configPath = realpath(dirname(__FILE__) . '/../../config/realaddress.php');

        $this->publishes([$configPath => config_path('realaddress.php')], 'realaddress');
        $this->mergeConfigFrom($configPath, 'realaddress');

    }

    /**
     *
     */
    public function register()
    {
        $this->app->bind(Generator::class, function ($app) {
            $faker = \Faker\Factory::create(config('app.faker_locale', 'en_US'));
            $faker->addProvider(new RealAddressFactoryFaker($faker));

            return $faker;
        });

    }


}
