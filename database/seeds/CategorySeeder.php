<?php


use App\Entity\CatalogueCategory;
use App\Entity\CatalogueCategoryLocale;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
            $starter = new CatalogueCategory();
//            $starter->save();

            $plat = new CatalogueCategory();
//            $plat->save();

            $dessert = new CatalogueCategory();
//            $dessert->save();

            $boisson = new CatalogueCategory();
//            $boisson->save();

            $formule = new CatalogueCategory();
//            $formule->save();

            $coldStarter = new CatalogueCategory();
//            $coldStarter->save();

            foreach (['locale' => ['fr', 'us', 'es']] as $locale) {
                $catLocale = new CatalogueCategoryLocale();
                $catLocale->libelle = 'Entrée';
            }
    }
}
