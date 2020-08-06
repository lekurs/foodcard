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

    protected $table = 'catalogue_product_medias';

    public function catalogueProduct(): BelongsTo
    {
        return $this->belongsTo(CatalogueProduct::class);
    }
}
