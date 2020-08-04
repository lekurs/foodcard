<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stripe\Product;

class CatalogueCategoryLocale extends Model
{
    protected $fillable = [
      'libelle',
      'icon',
      'color',
      'img_path',
      'slug'
    ];

    public function locale(): BelongsTo
    {
        return $this->belongsTo(Locale::class);
    }

    public function catalogueCategory(): BelongsTo
    {
        return $this->belongsTo(CatalogueCategory::class, 'catalogue_category_id');
    }

    public function catalogueCategoryByOrder(): BelongsTo
    {
        return $this->belongsTo(CatalogueCategory::class, 'catalogue_category_id')
            ->orderBy('parent', 'ASC')
            ->orderBy('position', 'ASC');
    }

    public function catalogueCategoryByOrderNoSubCategory(): BelongsTo
    {
        return $this->belongsTo(CatalogueCategory::class, 'catalogue_category_id')
            ->whereNull('parent')
            ->orderBy('position', 'ASC');
    }

    public function withParent(): BelongsTo
    {
        return $this->belongsTo(CatalogueCategory::class, 'catalogue_category_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(CatalogueProduct::class, 'products_categories');
    }

    public function withProducts(): BelongsToMany
    {
        return $this->belongsToMany(CatalogueProduct::class, 'products_categories');
    }
}
