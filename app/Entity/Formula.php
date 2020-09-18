<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Formula extends Model
{
    protected $fillable = [
        'comments',
    ];

    public function formulaTypes(): BelongsTo
    {
        return $this->belongsTo(FormulaType::class, 'formulatype_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(CatalogueProduct::class, 'catalogue_product_id');
    }
}
