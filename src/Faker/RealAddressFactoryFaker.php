<?php

namespace Nonsapiens\RealAddressFactory\Faker;

use Faker\Provider\Address;
use Nonsapiens\RealAddressFactory\RealAddressFactory;

/**
 * Class RealAddressFactoryFaker.php
 * @package Nonsapiens\RealAddressFactory\Faker
 */
class RealAddressFactoryFaker extends Address
{

    /**
     * @param string $country
     * @param null $cities
     * @return \Geocoder\Model\Address
     */
	public function realAddress( string $country, $cities = null )
	{
		$factory = new RealAddressFactory();

		return $factory->make(1, $country, $cities )->first();
	}

    /**
     * @param null $cities
     * @return \Geocoder\Model\Address
     */
	public function southAfricanAddress( $cities = null )
	{
		$factory = new RealAddressFactory();

		return $factory->makeSouthAfrica(1, $cities )->first();
	}

    /**
     * @param null $cities
     * @return \Geocoder\Model\Address
     */
	public function britishAddress( $cities = null )
	{
		$factory = new RealAddressFactory();

		return $factory->makeBritain(1, $cities )->first();
	}

    /**
     * @param null $cities
     * @return \Geocoder\Model\Address
     */
	public function frenchAddress( $cities = null )
	{
		$factory = new RealAddressFactory();

		return $factory->makeFrance(1, $cities )->first();
	}

    /**
     * @param null $cities
     * @return \Geocoder\Model\Address
     */
	public function germanAddress( $cities = null )
	{
		$factory = new RealAddressFactory();

		return $factory->makeGermany(1, $cities )->first();
	}

    /**
     * @param null $cities
     * @return \Geocoder\Model\Address
     */
	public function usaAddress( $cities = null )
	{
		$factory = new RealAddressFactory();

		return $factory->makeUsa(1, $cities )->first();
	}

    /**
     * @param null $cities
     * @return \Geocoder\Model\Address
     */
	public function russianAddress($cities = null)
	{
		$factory = new RealAddressFactory();

		return $factory->makeRussian(1, $cities )->first();
	}


}
