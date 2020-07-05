<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogueCategoryLocale extends Model
{
    protected $fillable = [
      'name'
    ];

    public function locale(): BelongsTo
    {
        return $this->belongsTo(Locale::class);
    }
}
