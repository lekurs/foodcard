<?php

use App\Entity\Store;
use Faker\Provider\fr_FR\Address;
use Faker\Provider\fr_FR\Company;
use Faker\Provider\fr_FR\PhoneNumber;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create('fr_FR');

        $faker->addProvider(new Company($faker));
        $faker->addProvider(new PhoneNumber($faker));
        $faker->addProvider(new Address($faker));
//        factory(Store::class, 100)->create();
        for ($i = 0; $i <= 100; $i++) {
            $name = $faker->name;

            $store = new Store();
            $store->name = $name;
            $store->siren = $faker->siren;
            $store->address = $faker->address;
            $store->zip = str_pad(rand(1, 95000), 6, 0,  STR_PAD_LEFT);
            $store->city = $faker->city;
            $store->active = rand(0, 1);
            $store->slug = Str::slug($name);
            $store->store_type_id = rand(1, 5);
            $store->save();
        }
    }
}
