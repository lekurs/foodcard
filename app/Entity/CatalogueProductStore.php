<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogueProductStore extends Model
{
    protected $fillable = [
        'field',
        'value'
    ];

    protected $primaryKey = ['field', 'product_id', 'store_id'];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
