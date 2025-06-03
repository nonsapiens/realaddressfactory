<?php

namespace Nonsapiens\RealAddressFactory;

use Geocoder\Model\Address;
use Geocoder\Model\Bounds;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use RuntimeException;

/**
 * Class RealAddressFactory
 *
 * @package     Nonsapiens\RealAddressFactory
 *
 * @author      Stuart Steedman
 * @date        12 February 2021
 *
 */
class RealAddressFactory
{
    /** @var int  */
    public static $rateCounter = 0;

    /**
     * @var Collection|Address[]
     */
    protected $addresses;

    /**
     * @var string[]
     */
    protected $countryMapping = [
        'SouthAfrica' => 'South Africa',
        'Usa' => 'United States of America',
        'Britain' => 'Great Britain',
        'France' => 'France',
        'Germany' => 'Germany',
        'Russia' => 'Russia',
        'Росси́я' => 'Russia'
    ];

    /**
     * AddressFactory constructor.
     */
    public function __construct()
    {
        $this->addresses = collect();
    }


    /**
     * @param $name
     * @param $arguments
     *
     * @return Collection|Address[]
     */
    public function __call($name, $arguments)
    {
        if (strpos($name, 'make') === 0) {
            return $this->make(
                $arguments[0],
                $this->countryMapping[substr($name, 4, strlen($name) - 4)],
                array_key_exists(1, $arguments) ? $arguments[1] : null
            );
        }
    }


    /**
     * @param int $count
     * @param null|string|array $locations
     *
     * @return Collection|Address[]
     */
    public function makeSouthAfrica(int $count, $locations = null)
    {
        return $this->make($count, 'SouthAfrica', $locations);
    }

    /**
     * @param int $count
     * @param null|string|array $locations
     *
     * @return Collection|Address[]
     */
    public function makeUsa(int $count, $locations = null)
    {
        return $this->make($count, 'UnitedStatesOfAmerica', $locations);
    }

    /**
     * @param int $count
     * @param null|string|array $locations
     *
     * @return Collection|Address[]
     */
    public function makeFrance(int $count, $locations = null)
    {
        return $this->make($count, 'France', $locations);
    }

    /**
     * @param int $count
     * @param null|string|array $locations
     *
     * @return Collection|Address[]
     */
    public function makeGermany(int $count, $locations = null)
    {
        return $this->make($count, 'Germany', $locations);
    }

    /**
     * @param int $count
     * @param null|string|array $locations
     *
     * @return Collection|Address[]
     */
    public function makeBritain(int $count, $locations = null)
    {
        return $this->make($count, 'GreatBritain', $locations);
    }

    /**
     * @param int $count
     * @param null|string|array $locations
     *
     * @return Collection|Address[]
     */
    public function makeRussian(int $count, $locations = null)
    {
        return $this->make($count, 'Russia', $locations);
    }

    /**
     * @param int $count
     * @param $locations
     *
     * @return Collection|Address[]
     */
    public function makeAustralian(int $count, $locations = null)
    {
        return $this->make($count, 'Australia', $locations);
    }


    /**
     * @param int $count The number of addresses to be generated
     * @param string $country The country of the addresses.
     * @param null|string|array|Collection $locations Optional locations, or array of locations, to filter by (such as cities, provinces states etc.)
     * @return Collection
     *@throws RuntimeException
     *
     */
    public function make(int $count, string $country, $locations = null) : Collection
    {
        $this->addresses = collect();

        if ($cnfCountry = Config::get('realaddress.countries.' . Str::kebab($country), false)) {

            if (is_null($locations)) $locations = $cnfCountry['cities'];
            if (is_string($locations)) $locations = [$locations];

            if (config('realaddress.rate-limiter') == -1 || self::$rateCounter <= config('realaddress.rate-limiter') ) {
                for ($i = 0; $i < $count; $i++) {
                    $query = implode(', ', [Arr::random($locations), $country]);

                    /** @var Address $country */
                    $lookup = app('geocoder')->geocode($query)->get()->first();

                    if ($lookup->getLocality()) {
                        /** @var Address $address */
                        $address = null;
                        while (empty($address) || !$address->getStreetName() || !$address->getStreetNumber()) {
                            $random = $this->getRandomCoordinates($lookup->getBounds());
                            $address = $this->performLookup(... $random);
                        }

                        $this->addresses->push($address);
                        self::$rateCounter++;
                    }
                }
            } else {
                throw new RuntimeException('Address Factory exceeded the rate limiter set');
            }
        }

        return $this->addresses;
    }

    /**
     * @param $lat
     * @param $lng
     * @return Address
     */
    protected function performLookup($lat, $lng) : Address
    {
        /** @var Address $address */
        $address = app('geocoder')->reverse($lat, $lng)->get()->first();

        return $address;
    }

    /**
     * @param Bounds $bounds
     * @return array
     */
    protected function getRandomCoordinates(Bounds $bounds) : array
    {
        $lat = $this->randomFloat(6, $bounds->getNorth(), $bounds->getSouth());
        $lng = $this->randomFloat(6, $bounds->getEast(), $bounds->getWest());

        return [$lat, $lng];
    }


    /**
     * Return a random float number
     *
     * @param int $nbMaxDecimals
     * @param int|float $min
     * @param int|float $max
     *
     * @return float
     * @example 48.8932
     */
    private function randomFloat(int $nbMaxDecimals, $min, $max) : float
    {
        if ($min > $max) {
            $tmp = $min;
            $min = $max;
            $max = $tmp;
        }

        return round($min + mt_rand() / mt_getrandmax() * ($max - $min), $nbMaxDecimals);
    }

}
