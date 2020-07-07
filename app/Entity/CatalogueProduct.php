<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatalogueProduct extends Model
{
    protected $fillable = [
      'active',
        'allergy'
    ];


    public function catalogueProductMedias(): HasMany
    {
        return $this->hasMany(CatalogueProductMedia::class);
    }

    public function catalogueProductCategories(): HasMany
    {
        return $this->hasMany(CatalogueProductCategory::class);
    }

    public function catalogueProductLocales(): HasMany
    {
        return $this->hasMany(CatalogueProductLocale::class, 'product_id')->where('locale_id', '=', 1);
    }

    public function catalogueProductLocalesAllLanguages(): HasMany
    {
        return $this->hasMany(CatalogueProductLocale::class, 'product_id');
    }

    public function catalogueProductFloats(): HasMany
    {
        return $this->hasMany(CatalogueProductFloat::class, 'product_id');
    }
}
