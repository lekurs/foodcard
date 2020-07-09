<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StoreType extends Model
{
    protected $fillable = [
        'type'
    ];

    public function stores(): HasMany
    {
        return $this->hasMany(Store::class);
    }
}
