<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shop extends Model
{
    protected $fillable = [
      'name',
      'siren',
      'address',
      'zip',
      'city',
      'type',
      'active',
      'slug'
    ];

    public function contactShop(): BelongsTo
    {
        return $this->belongsTo(ContactShop::class);
    }
}
