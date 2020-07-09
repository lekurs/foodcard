<?php

use Illuminate\Database\Seeder;

class UserAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\Entity\User();
        $user->name = "Gindre";
        $user->lastname = 'Maxime';
        $user->email = 'gindre.maxime@gmail.com';
        $user->password = \Illuminate\Support\Facades\Hash::make('mg261181');
        $user->slug = \Illuminate\Support\Str::slug($user->name .'-'.$user->lastname);
    }
}
