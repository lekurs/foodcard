<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogueProductLocale extends Model
{
    protected $fillable = [
        'libelle',
        'description',
        'allergy'
    ];

    public function locale(): BelongsTo
    {
        return $this->belongsTo(Locale::class);
    }
}
