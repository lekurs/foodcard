<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserFonction extends Model
{
    protected $fillable = [
      'fonction'
    ];

    public function Users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
