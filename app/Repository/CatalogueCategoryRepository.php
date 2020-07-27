<?php


namespace App\Repository;


use App\Entity\CatalogueCategory;
use App\Entity\CatalogueCategoryLocale;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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

    public function getCategoriesLabel()
    {
        $return = [];
        $req = CatalogueCategory::with('categoryLocalesFR')->get();

        foreach($req as $row){
            $return[$row->id] = $row->categoryLocalesFR()->first()->libelle;
        }
        return $return;
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
            $catalogueCategoryLocale->slug = $category;

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
