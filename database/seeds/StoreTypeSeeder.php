<?php

use App\Entity\StoreType;
use Illuminate\Database\Seeder;

class StoreTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(['Restaurant', 'Bar', 'Plage', 'Chambre d\'hôte', 'Hôtel'] as $type) {
            $storeType = new StoreType();
            $storeType->type = $type;
            $storeType->save();
        }
    }
}
