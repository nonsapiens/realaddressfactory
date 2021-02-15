<?php

namespace Nonsapiens\RealAddressFactory\Faker;

use Nonsapiens\RealAddressFactory\RealAddressFactory;

/**
 * Class RealAddressFactoryFaker.php
 * @package Nonsapiens\RealAddressFactory\Faker
 */
class RealAddressFactoryFaker extends \Faker\Provider\Address
{

    /**
     * @param $country
     * @param null $cities
     * @return mixed
     */
	public function realAddress( $country, $cities = null )
	{
		$factory = new RealAddressFactory();

		return $factory->make(1, $country, $cities )->first();
	}

    /**
     * @param $country
     * @param null $cities
     * @return mixed
     */
	public function southAfricanAddress( $cities = null )
	{
		$factory = new RealAddressFactory();

		return $factory->makeSouthAfrica(1, $cities )->first();
	}

    /**
     * @param $country
     * @param null $cities
     * @return mixed
     */
	public function britishAddress( $cities = null )
	{
		$factory = new RealAddressFactory();

		return $factory->makeBritain(1, $cities )->first();
	}

    /**
     * @param $country
     * @param null $cities
     * @return mixed
     */
	public function frenchAddress( $cities = null )
	{
		$factory = new RealAddressFactory();

		return $factory->makeFrance(1, $cities )->first();
	}

    /**
     * @param $country
     * @param null $cities
     * @return mixed
     */
	public function germanAddress( $cities = null )
	{
		$factory = new RealAddressFactory();

		return $factory->makeGermany(1, $cities )->first();
	}

    /**
     * @param $country
     * @param null $cities
     * @return mixed
     */
	public function usaAddress( $cities = null )
	{
		$factory = new RealAddressFactory();

		return $factory->makeUsa(1, $cities )->first();
	}

    /**
     * @param $country
     * @param null $cities
     * @return mixed
     */
	public function russianAddress($cities = null)
	{
		$factory = new RealAddressFactory();

		return $factory->makeRussian(1, $cities )->first();
	}


}
