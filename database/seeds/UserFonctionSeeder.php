<?php

use Illuminate\Database\Seeder;

class UserFonctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Gérant', 'Comptabilité', 'Serveur', 'Chef de rang', 'Runner', 'Barmaid', 'Autre'] as $fonctions) {
            $userFonction = new \App\Entity\UserFonction();
            $userFonction->fonction = $fonctions;
            $userFonction->save();
        }
    }
}
