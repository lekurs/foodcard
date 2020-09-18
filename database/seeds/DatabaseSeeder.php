<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LocalSeeder::class,
            UserRoleSeeder::class,
            UserFonctionSeeder::class,
            UserAdmin::class,
            StoreTypeSeeder::class,
            StoreSeeder::class,
            FormulatypeSeeder::class
        ]);
    }
}
