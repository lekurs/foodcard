<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogueProductMedia extends Model
{
    protected $fillable = [
        'path',
        'position'
    ];

    public function catalogueProduct(): BelongsTo
    {
        return $this->belongsTo(CatalogueProduct::class);
    }
}
