<?php


namespace App\Repository;


use App\Entity\CatalogueCategoryLocale;
use Illuminate\Database\Eloquent\Collection;

class CatalogueCategoryLocaleRepository
{
    public function getAll(): Collection
    {
        return CatalogueCategoryLocale::whereLocaleId(1)->get();
    }

    public function getAllWithCatalogueCategories(): Collection
    {
        return CatalogueCategoryLocale::whereLocaleId(1)->with('catalogueCategoryByOrder')->get();
    }
}
