<?php

use Illuminate\Database\Seeder;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['FR', 'EN', 'ES'] as $localeStr) {
            $locale = new \App\Entity\Locale();
            $locale->label = $localeStr;
            $locale->save();
        }
    }
}
