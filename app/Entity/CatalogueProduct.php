<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatalogueProduct extends Model
{
    protected $fillable = [
      'active'
    ];


    public function catalogueProductMedias(): HasMany
    {
        return $this->hasMany(CatalogueProductMedia::class);
    }

    public function catalogueProductCategories(): HasMany
    {
        return $this->hasMany(CatalogueProductCategory::class);
    }
}
