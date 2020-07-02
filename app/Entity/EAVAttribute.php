<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EAVAttribute extends Model
{
    protected $fillable = [
        'attribute_code',
        'attribute_type'
    ];

    public function eavAttributes(): HasMany
    {
        return $this->hasMany(EAVAttribute::class);
    }

    public function eavAttributesValues(): HasMany
    {
        return $this->hasMany(EAVAttributeValue::class);
    }

    public function eavAttributesTypes(): HasMany
    {
        return $this->hasMany(EAVAttributeType::class);
    }

    public function menus(): HasMany
    {
        return $this->hasMany(CatalogueRecette::class);
    }

    public function catalogueMenus(): HasMany
    {
        return $this->hasMany(CatalogueRecette::class);
    }
}
