<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
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
}
