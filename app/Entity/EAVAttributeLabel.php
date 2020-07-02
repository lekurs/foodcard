<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EAVAttributeLabel extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'label'
    ];

    public function eavAttributesLanguage(): BelongsTo
    {
        return $this->belongsTo(EAVAttributeLanguage::class);
    }

    public function eavAttributes(): BelongsTo
    {
        return $this->belongsTo(EAVAttribute::class);
    }
}
