<?php

return [

    // Use to prevent accidental overrun of API calls to Google.  Set to -1 for infinite
    'rate-limiter' => 50,

    // You can add your own countries and cities here
    'countries' => [
        'south-africa' => [
            'cities' => ['Johannesburg', 'Cape Town', 'Durban', 'Bloemfontein', 'Pietermaritzburg', 'Port Elizabeth', 'East London', 'Pretoria', 'Polokwane'],
        ],

        'united-states-of-america' => [
            'cities' => ['New York, NY', 'Los Angeles, CA', 'San Francisco, CA', 'Dallas, TX', 'Chicago, IL', 'Houston, TX', 'Phoenix, AZ', 'San Diego, CA'],
        ],

        'great-britain' => [
            'cities' => ['London', 'Manchester', 'Coventry', 'Liverpool', 'Leeds', 'Birmingham', 'Cambridge', 'Sheffield', 'Glasgow', 'Bath', 'Edinburgh'],
        ],

        'france' => [
            'cities' => ['Paris', 'Marseille', 'Bordeaux', 'Nice', 'Strasbourg', 'Toulouse', 'Lille', 'Lyon', 'Rouen', 'Cannes'],
        ],

        'germany' => [
            'cities' => ['Berlin', 'Munich', 'Hamburg', 'Frankfurt', 'Cologne', 'Bonn', 'Bremen', 'Nurumberg', 'Dresden', 'Dortmund', 'Stuttgart', 'Hanover'],
        ],

        'russia' => [
            'cities' => ['Moscow', 'Saint Petersburg', 'Novosibirsk', 'Yekaterinburg', 'Nizhny Novgorod', 'Kazan', 'Chelyabinsk', 'Omsk', 'Samara', 'Rostov-on-Don'],
        ]
    ]
];