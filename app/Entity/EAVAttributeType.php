<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EAVAttributeType extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'fields'
    ];

    public function eavAttributes(): HasMany
    {
    return $this->hasMany(EAVAttribute::class);
    }
}
