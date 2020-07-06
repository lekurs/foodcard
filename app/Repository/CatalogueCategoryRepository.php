<?php


namespace App\Repository;


use App\Entity\CatalogueCategory;
use App\Entity\CatalogueCategoryLocale;
use Illuminate\Database\Eloquent\Collection;

class CatalogueCategoryRepository
{

    public function getAll(): Collection
    {
        return CatalogueCategory::all();
    }

    public function store(array $datas)
    {
        if (is_null($datas['category_id'])) {
            $catalogueCategory = new CatalogueCategory();
            $catalogueCategory->parent = $datas['category-parent'];
//            $catalogueCategory->position = $datas['category-position'];
            $catalogueCategory->position = 0;

            $catalogueCategory->save();

            $lastid = $catalogueCategory->id;

            foreach ($datas['category'] as $locale_id => $category) {
                $catalogueCategoryLocale = new CatalogueCategoryLocale();
                $catalogueCategoryLocale->libelle = $category;
                $catalogueCategoryLocale->locale_id = $locale_id;
                $catalogueCategoryLocale->catalogue_category_id = $lastid;

                $catalogueCategoryLocale->save();
            }

        } else {
            //On update
        }


    }

}
