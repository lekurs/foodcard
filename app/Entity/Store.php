<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    protected $fillable = [
      'name',
      'siren',
      'address',
      'address_complement',
      'zip',
      'city',
      'active',
      'slug'
    ];

    public function catalogueProductStore(): HasMany
    {
        return $this->hasMany(CatalogueProductStore::class);
    }

    public function Users(): HasMany
    {
        return $this->HasMany(User::class);
    }

    public function storeMedias(): HasMany
    {
        return $this->hasMany(StoreMedia::class);
    }

    public function catalogueProducts(): HasMany
    {
        return $this->hasMany(CatalogueProduct::class);
    }

    public function storeType(): BelongsTo
    {
        return $this->belongsTo(StoreType::class, 'store_type_id');
    }
}
