<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatalogueProduct extends Model
{
    protected $fillable = [
      'price'
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function catalogueProductType(): BelongsTo
    {
        return $this->belongsTo(CatalogueProductType::class);
    }

    public function catalogueProductMedias(): HasMany
    {
        return $this->hasMany(CatalogueProductMedia::class);
    }
}
