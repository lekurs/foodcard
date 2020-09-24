<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allergy extends Model
{
    protected $fillable = [
        'label',
        'icon'
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(CatalogueProduct::class, 'allergies_catalogue_products');
    }
}
