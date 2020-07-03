<?php


namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserRole extends Model
{
    protected $fillable = [
        'role'
    ];

    public function Users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
