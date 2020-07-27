<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatalogueProductLocale extends Model
{
    protected $fillable = [
        'libelle',
        'description',
        'homemade'
    ];

    public function locale(): BelongsTo
    {
        return $this->belongsTo(Locale::class, 'locale_id');
    }

    public function catalogueProducts(): HasMany
    {
        return $this->hasMany(CatalogueProduct::class, 'product_id');
    }

    public function catalogueProductFloats(): HasMany
    {
        return $this->hasMany(CatalogueProductFloat::class, 'product_id');
    }
}
