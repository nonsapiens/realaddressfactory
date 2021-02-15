<?php

namespace Nonsapiens\AddressFactory;

use Illuminate\Support\Facades\Facade;
use Nonsapiens\RealAddressFactory\RealAddressFactory;

class AddressFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return RealAddressFactory::class;
    }

}