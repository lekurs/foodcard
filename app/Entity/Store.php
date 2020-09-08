<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class Store extends Model
{
    protected $fillable = [
      'name',
      'siren',
      'address',
      'address_complement',
      'zip',
      'city',
      'main',
      'active',
      'slug'
    ];

    public function catalogueProductStore(): HasMany
    {
        return $this->hasMany(CatalogueProductStore::class);
    }

    public function Users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_stores');
    }

    public function storeMedias(): HasMany
    {
        return $this->hasMany(StoreMedia::class, 'store_id');
    }

    public function catalogueProducts(): HasMany
    {
        return $this->hasMany(CatalogueProduct::class);
    }

    public function storeType(): BelongsTo
    {
        return $this->belongsTo(StoreType::class, 'store_type_id');
    }

    public function scopeStoreMain(Builder $query)
    {
        return $query->whereMain(true);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(CatalogueProduct::class, 'stores_products');
    }
}
