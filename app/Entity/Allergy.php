<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allergy extends Model
{
    protected $fillable = [
        'label',
        'icon'
    ];
}
