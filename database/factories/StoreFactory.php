<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entity\Store;
use Faker\Generator as Faker;
use Faker\Provider\fr_FR\Address;
use Faker\Provider\fr_FR\Company;
use Faker\Provider\fr_FR\PhoneNumber;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Store::class, function (Faker $faker) {
    $faker->addProvider(new Company($faker));
    $faker->addProvider(new PhoneNumber($faker));
    $faker->addProvider(new Address($faker));

    $name = $faker->name;

    return [
        'name' => $name,
        'siren' => $faker->siren,
        'address' => $faker->address,
        'zip' => str_pad(rand(1, 95000), 6, 0,  STR_PAD_LEFT),
        'city' => $faker->city,
        'active' => rand(0, 1),
        'slug' => Str::slug($name),
        'store_type_id' => rand(1, 5)
    ];
});
