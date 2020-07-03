<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Locale extends Model
{
    protected $fillable = [
      'label'
    ];

    public function catalogueProductLocales(): HasMany
    {
        return $this->hasMany(CatalogueProductLocale::class);
    }
}
