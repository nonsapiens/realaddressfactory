# RealAddress Generator
## About
This Laravel 8+ library creates actual, 100% real addresses, with full address details and lat/long coordinates
Using the Google Maps API, these addresses can be created using the RealAddress classes, and also supports Faker, so you can use RealAddress in your database seeding!

## Installation
Require this package with composer using the following command:
```bash
composer require nonsapiens/realaddressfactory --dev 
```

### Google Maps API

As this library relies on Google Maps, your Google Maps API key needs to be defined in your `.env` file:
```
GOOGLE_MAPS_API_KEY=abcdefghijklmnopqrstuv
```
If you don't have an API key, [get one here](https://developers.google.com/maps/documentation/javascript/get-api-key)

## Usage

RealAddress offers three different ways of generating real-world addresses.  [Each of these methods return the `\Geocoder\Provider\GoogleMaps\Model\GoogleAddress` class](http://geocoder-php.org/Geocoder/), which takes the Google Maps API response and standardises it in an easy-to-use, easy-to-read manner.
As standard, RealAddress supports the generating of real addresses for the following countries:

* United States of America
* Great Britain
* France
* Germany
* South Africa
* Russia

You can extend RealAddress by adding additional countries in the `config/realaddress.php` config file.  This config file also defines which cities in a given country addresses can be created for.  Additional cities can be defined here.

### Faker

RealAddress provides additional functions for Faker's `\Faker\Generator` class instance.  The code example below shows typical usage in a Factory class:


```php
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        /** @var GoogleAddress $address */
        $address = $this->faker->britishAddress();

        return [
            'first_name' => $this->faker->firstName($gender),
            'last_name' => $this->faker->lastName,
            'full_address' => $address->getFormattedAddress(),
		    'latitude' => $address->getCoordinates()->getLatitude(),
		    'longitude' => $address->getCoordinates()->getLongitude()
        ];
    }
}
```

Similarly, the address can be limited to a specific city: `$address = $faker->britishAddress('London');`

or can be generated randomly between multiple-defined cities: `$address = $faker->britishAddress(['London', 'Manchester']);`

... where these cities must be defined in `config/realaddress.php` in order to work.

The ready-to-use faker functions include:
* `britishAddress()`
* `usaAddress()`
* `germanAddress()`
* `frenchAddress()`
* `southAfricanAddress()`
* `russianAddress()`

If you have extended `config/realaddress.php` to include a new country, you can generate an address for it with:
```php
	$address = $faker->realAddress('Brazil')						# From any of the defined cities
	$address = $faker->realAddress('Brazil', 'Rio de Janiero');		# For Rio de Janiero only
	$address = $faker->realAddresss('Brazil', ['Rio de Janiero', 'Salvador'])	# Multiple cities
```

### Using the Facade

Using the Facade allows you to generate real-world addresses at runtime, and also allows *multiple* addresses to be generated at once.
The code examples below show typical RealAddress facade usage:

```php
use Nonsapiens\RealAddressFactory\RealAddressFactory;
.
.
.
$johannesburgAddresses          = RealAddress::makeSouthAfrica(20, 'Johannesburg');		# 20 addresses for Johannesburg, South Africa
$frenchAddress                  = RealAddress::makeFrance(1);							# A single address for France
$brazilAddresses                = RealAddress::make(10, 'Brazil');						# 10 addresses for the custom country of Brazil
```

### Using the RealAddress class

Functionally, provides the same methods as the Facade above:

```php
use Nonsapiens\RealAddressFactory\RealAddressFactory;

$f = new RealAddressFactory();

$southAfricanPoints = $f->makeSouthAfrica(4);                # Generates 4 locations within South Africa's major cities
$capeTownPoints     = $f->makeSouthAfrica(2, 'Cape Town');   # Generates 2 locations from Cape Town, South Africa
$multiPoints        = $f->makeSouthAfrica(3, ['Pretoria', 'Johannesburg']);
```

### Adding new countries or cities

An example of extending the `config/realaddress.php` array to include Kenya, and two cities:

```php
'kenya' => [
		'cities' => [ 'Nairobi', 'Mombasa' ],
	   ],
```

Note that the cities defined here must be identifiable to Google Maps, and should ideally be spelt in their English variant.


### Warning
Extended and heavy use of this factory may cause Google to block your key.
Heavy use may also attract GCP API charges, subject to Google's Places API costing structure.
To help prevent this, there is a built in rate-limiter, that blocks too many calls being made to the Google API.  This value is configurable inside the `config/realaddress.php` config file

## About the author

[**Stuart Steedman**](https://www.linkedin.com/in/stuart-steedman-b612a537/) is CTO of [Yonder Media](http://www.yonder.co.za), a GroupM/WPP South African digital media agency operating out of Bryanston.
He specialises in PHP and Laravel development, and is a speaker at tech and development related conferences.

[**Jonathan Maurer**](https://www.linkedin.com/in/jonathan--maurer) is a senior developer at [Yonder Media](http://www.yonder.co.za), a GroupM/WPP South African digital media agency operating out of Pretoria.
He specialises in PHP and Laravel development.
