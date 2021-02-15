<?php

namespace Nonsapiens\RealAddressFactory\Tests;

use Nonsapiens\RealAddressFactory\RealAddressFactoryServiceProvider;

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
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('realaddress.rate-limiter', 50);
    }
}