<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreMedia extends Model
{
    protected $fillable = [
      'position',
      'path',
      'type'
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
