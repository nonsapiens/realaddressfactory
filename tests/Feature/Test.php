<?php

namespace Nonsapiens\Tests\Feature;

use Geocoder\Provider\GoogleMaps\Model\GoogleAddress;
use Nonsapiens\RealAddressFactory\RealAddressFactory;
use Nonsapiens\Tests\TestCase;
use Geocoder\Model\Coordinates;

class Test extends TestCase
{
    public function testJohannesburgInBoundsTest()
    {
        $f = new RealAddressFactory();
        $JohannesburgPoint = $f->makeSouthAfrica(1, "Johannesburg")[0];

        $this->assertTrue($JohannesburgPoint->getCoordinates()->getLongitude() < 28.1376001);
        $this->assertTrue($JohannesburgPoint->getCoordinates()->getLongitude() > 27.942449);
        $this->assertTrue($JohannesburgPoint->getCoordinates()->getLatitude() < -26.1041199);
        $this->assertTrue($JohannesburgPoint->getCoordinates()->getLatitude() > -26.2389231);
    }

    public function testCapeTownInBoundsTest()
    {
        $f = new RealAddressFactory();
        $CapeTownPoint = $f->makeSouthAfrica(1, "Cape Town")[0];

        $this->assertTrue($CapeTownPoint->getCoordinates()->getLongitude() < 19.00467);
        $this->assertTrue($CapeTownPoint->getCoordinates()->getLongitude() > 18.3074488);
        $this->assertTrue($CapeTownPoint->getCoordinates()->getLatitude() < -33.47127);
        $this->assertTrue($CapeTownPoint->getCoordinates()->getLatitude() > -34.3598061);
    }
}
