<?php

use App\Entity\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Gindre";
        $user->lastname = 'Maxime';
        $user->email = 'gindre.maxime@gmail.com';
        $user->password = Hash::make('mg261181');
        $user->slug = Str::slug($user->name .'-'.$user->lastname);
        $user->user_role_id = 1;
        $user->save();
    }
}
