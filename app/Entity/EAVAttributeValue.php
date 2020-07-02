<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EAVAttributeValue extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'value',
    ];

    public function eavAttribute(): BelongsTo
    {
        return $this->belongsTo(EAVAttribute::class);
    }

    public function eavLangage(): BelongsTo
    {
        return $this->belongsTo(EAVAttributeLanguage::class);
    }
}
