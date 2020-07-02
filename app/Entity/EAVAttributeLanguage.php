<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EAVAttributeLanguage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'libelle'
    ];

    public function eavLabels(): HasMany
    {
        return $this->hasMany(EAVAttributeLabel::class);
    }

    public function eavValues(): HasMany
    {
        return $this->hasMany(EAVAttributeValue::class);
    }
}
