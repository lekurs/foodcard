<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogueProductCategory extends Model
{
    public $timestamps = false;

    public function catalogueCategory(): BelongsTo
    {
        return $this->belongsTo(CatalogueCategory::class);
    }

    public function catalogueProduct(): BelongsTo
    {
        return $this->belongsTo(CatalogueProduct::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
