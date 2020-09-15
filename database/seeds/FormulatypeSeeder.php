<?php

use App\Entity\FormulaType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FormulatypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $formulaTypes = [
            ['label' => 'entrée - plat', 'icon' => 'icon-1'],
            ['label' => 'plat - dessert', 'icon' => 'icon-2'],
            ['label' => 'entrée - plat - dessert', 'icon' => 'icon-3']
        ];

        foreach ($formulaTypes as $key => $formulaType) {
                $formula = new FormulaType();
                $formula->label = $formulaType['label'];
                $formula->slug = Str::slug($formulaType['label']);
                $formula->icon = $formulaType['icon'];

                $formula->save();
        }
    }
}
