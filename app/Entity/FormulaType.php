<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormulaType extends Model
{
    protected $table = 'formulatypes';

    protected $fillable = [
      'label',
      'slug',
      'icon'
    ];

    public function formula(): HasMany
    {
        return $this->hasMany(Formula::class, 'formula_id');
    }
}
