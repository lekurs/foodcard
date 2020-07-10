<?php


namespace App\Repository;


use App\Entity\CatalogueCategory;
use App\Entity\CatalogueCategoryLocale;
use Illuminate\Database\Eloquent\Collection;

class CatalogueCategoryRepository
{

    public function getAll()
    {
        return CatalogueCategory::with('catalogueCategoryLocales');
    }

    public function store(array $datas)
    {
        $catalogueCategory = new CatalogueCategory();
        $catalogueCategory->save();

        $lastid = $catalogueCategory->id;

        foreach ($datas['category'] as $locale_id => $category) {
            $catalogueCategoryLocale = new CatalogueCategoryLocale();
            $catalogueCategoryLocale->libelle = $category;
            $catalogueCategoryLocale->locale_id = $locale_id;
            $catalogueCategoryLocale->catalogue_category_id = $lastid;

            $catalogueCategoryLocale->save();
        }
    }

    public function update(array $datas): void
    {
        foreach ($datas as $key => $value) {
            $catalogueCategory = CatalogueCategory::find($value['id']);
            $catalogueCategory->parent = $value['parent'];
            $catalogueCategory->position = $key;

            $catalogueCategory->save();
        }
    }

}
