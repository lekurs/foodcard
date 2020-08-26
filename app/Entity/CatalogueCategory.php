<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatalogueCategory extends Model
{
    protected $fillable = [
      'parent',
      'position'
    ];

    public function catalogueProductCategories(): HasMany
    {
        return $this->hasMany(CatalogueProductCategory::class);
    }

    public function catalogueCategoryLocales(): HasMany
    {
        return $this->hasMany(CatalogueCategoryLocale::class, 'catalogue_category_id');
    }

    public function categoryLocalesFR(): HasMany
    {
        return $this->catalogueCategoryLocales()->where('locale_id', '=', 1);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(CatalogueProduct::class ,'products_categories');
    }
}
