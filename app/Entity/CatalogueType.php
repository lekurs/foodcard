<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogueType extends Model
{
     public $timestamps = false;

     protected $fillable = [];

     public function eavAttribute(): BelongsTo
     {
         return $this->belongsTo(EAVAttribute::class);
     }

     public function eavAttributeValue(): BelongsTo
     {
         return $this->belongsTo(EAVAttributeValue::class);
     }
}
