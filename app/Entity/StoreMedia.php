<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

class StoreMedia extends Model
{
    protected $fillable = [
      'position',
      'path',
      'type'
    ];

    protected $table = "store_medias";

    public function stores(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_media_id');
    }

    public function pivotLogo(Builder $query)
    {
        $query->whereType('logo');
    }
}
