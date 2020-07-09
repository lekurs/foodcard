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
        $this->call(LocalSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(UserAdmin::class);
        // $this->call(UserSeeder::class);
    }
}
