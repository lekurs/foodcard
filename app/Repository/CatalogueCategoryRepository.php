<?php


namespace App\Repository;


use App\Entity\CatalogueCategory;
use App\Entity\CatalogueCategoryLocale;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CatalogueCategoryRepository
{

    public function getAll()
    {
        return CatalogueCategory::with('catalogueCategoryLocales')->get();
    }

    public function getCategoriesWithChildren()
    {
        $categories = [];

        $query = DB::select(
            "select c.id, c.parent, c.position,
                    (select GROUP_CONCAT(id SEPARATOR \",\") from catalogue_categories where parent=c.id) as children
                    from catalogue_categories as c order by position"
                );

        foreach ($query as $category) {
            $categories[$category->id] = $category;
        }

        return $categories;
    }

    public function getOneById(int $id) {
        return CatalogueCategory::whereId($id)->first();
    }

    public function getOneWithLocalesById(int $id) {

        return CatalogueCategory::with('categoryLocalesFR')->whereId($id)->first();
    }

    public function getCategoriesLabel()
    {
        $return = [];
        $req = CatalogueCategory::with('categoryLocalesFR')->get();

        foreach($req as $row){
            $return[$row->id] = $row->categoryLocalesFR()->first()->libelle;
        }
        return $return;
    }

    public function getCategoriesLabelByParent()
    {
        $return = [];
        $req = CatalogueCategory::with('categoryLocalesFR')->get();

        foreach ($req as $row) {
            if (!is_null($row->parent)) {
                $return[$row->parent][$row->categoryLocalesFR()->first()->libelle][] = $row->categoryLocalesFR()->first()->img_path;
            }
        }

        return $return;
    }

    public function getAllProductsByCategory($id) {

        $categories = CatalogueCategory::with('products.langueFR', 'products.stores')->whereId($id)->first();
        $products = $categories->products;
        $storeInProgress = request()->session()->get('store');

        $result = [];

        foreach ($products as $product) {
            $visibility = $product->visibility;

            if ($visibility == "all") {
                array_push($result, $product);
            } else {
                if (count($product->stores) > 0) {
                    foreach ($product->stores as $store) {
                        if ($storeInProgress->id === $store->id) {
                            array_push($result, $product);
                        }
                    }
                }
            }
        }

        return $result;
    }

    public function store(array $datas)
    {
        $catalogueCategory = new CatalogueCategory();
        $catalogueCategory->save();

        $lastid = $catalogueCategory->id;

        foreach ($datas['category'] as $locale_id => $category) {
            $catalogueCategoryLocale = new CatalogueCategoryLocale();
            $catalogueCategoryLocale->libelle = $category;
            $catalogueCategoryLocale->icon = $datas['icon'];
            $catalogueCategoryLocale->color = $datas['color'];
            $catalogueCategoryLocale->locale_id = $locale_id;
            $catalogueCategoryLocale->catalogue_category_id = $lastid;
            if (isset($datas['img-category'])) {
                $catalogueCategoryLocale->img_path = $datas['img-category']->getClientOriginalName();
            }
            $catalogueCategoryLocale->slug = Str::slug($category);

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
