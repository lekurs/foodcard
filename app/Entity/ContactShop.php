<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactShop extends Model
{
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'phone',
        'business-role',
        'slug'
    ];

    public function shops(): HasMany
    {
        return $this->hasMany(Shop::class);
    }
}
