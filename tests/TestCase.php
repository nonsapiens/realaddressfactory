<?php

namespace Nonsapiens\Tests;

use Geocoder\Laravel\Providers\GeocoderService;
use Nonsapiens\RealAddressFactory\Providers\RealAddressFactoryServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();


    }

    protected function getPackageProviders($app)
    {
        return [
            RealAddressFactoryServiceProvider::class,
            GeocoderService::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('realaddress.rate-limiter', 50);
        $app['config']->set('realaddress.countries.south-africa.cities', ['Johannesburg', 'Cape Town', 'Durban', 'Bloemfontein', 'Pietermaritzburg', 'Port Elizabeth', 'East London', 'Pretoria', 'Polokwane']);

    }


}