<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Admin', 'User', 'Contrib'] as $rolesStr)
        {
            $userRole = new \App\Entity\UserRole();
            $userRole->role = $rolesStr;
            $userRole->save();
        }
    }
}
