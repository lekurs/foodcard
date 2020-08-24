<?php


namespace App\Repository;


use App\Entity\CatalogueCategoryLocale;
use App\Entity\CatalogueProduct;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CatalogueCategoryLocaleRepository
{

    public function getAll(): Collection
    {
        return CatalogueCategoryLocale::whereLocaleId(1)->get();
    }

    public function getOneById(int $id) {

        return CatalogueCategoryLocale::whereId($id)->first();
    }

    public function getOneByIdWithProducts(int $id) {

        return CatalogueCategoryLocale::with('products.langueFR', 'products.catalogueProductMedias')->whereId($id)->first();
    }

    public function getAllProductsByCategory(int $id) {

         $category = CatalogueCategoryLocale::with('products', 'products.langueFR')->whereId($id)->first();

         dd($category->products()->get());

         return $products;

    }

    public function getAllWithCatalogueCategories(): Collection
    {
        return CatalogueCategoryLocale::whereLocaleId(1)->with('catalogueCategoryByOrder')->get();
    }

    public function getCategoriesLabelNoParent(): array
    {
        $categories =  CatalogueCategoryLocale::whereLocaleId(1)->with('catalogueCategoryByOrderNoSubCategory')->get();
        $return = [];

        foreach($categories as $row) {
            if (!is_null($row->catalogueCategoryByOrderNoSubCategory()->first()))
            $return[] = $row;
        }

        return $return;
    }

    public function getAllSubCategoriesByIdCategory(int $id) {
        $result = [];

        $query = DB::select("select c.* FROM catalogue_category_locales as c LEFT JOIN catalogue_categories as cc ON c.catalogue_category_id = cc.id WHERE cc.parent = " . $id . " AND c.locale_id = 1");

        foreach ($query as $row) {
            $result[] = ['id' => $row->id, 'libelle' => $row->libelle, 'img_path' => $row->img_path, 'catalogue_category_id' => $row->catalogue_category_id];
        }

        return $result;
    }

    public function getAllProductsWithMediasByIdCategory(int $id) {
        return CatalogueCategoryLocale::with('products.catalogueProductMedias')->whereId($id)->get();
    }

    public function getAllProductsByIdCategory(int $id) {

       return CatalogueCategoryLocale::with('products.langueFR')->whereId($id)->get();
    }

    public function getOneBySlug(string $slug): CatalogueCategoryLocale
    {
        return CatalogueCategoryLocale::whereSlug($slug)->with('catalogueCategoryByOrder')->first();
    }
}
