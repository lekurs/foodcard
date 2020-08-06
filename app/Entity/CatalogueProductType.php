<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatalogueProductType extends Model
{
    protected $fillable = [
      'type'
    ];

    public function catalogueProducts(): HasMany
    {
        return $this->hasMany(CatalogueProduct::class);
    }
}
