<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogueRecette extends Model
{
    protected $fillable = [];

    public function shop():BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function catalogueType(): BelongsTo
    {
        return $this->belongsTo(CatalogueType::class);
    }

    public function eavAttribute(): BelongsTo
    {
        return $this->belongsTo(EAVAttribute::class);
    }
}
