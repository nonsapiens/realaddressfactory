<?php

namespace Nonsapiens\RealAddressFactory\Facades;

use Illuminate\Support\Facades\Facade;
use Nonsapiens\RealAddressFactory\RealAddressFactory;

class RealAddressFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return RealAddressFactory::class;
    }

}