<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogueCategoryLocale extends Model
{
    protected $fillable = [
      'libelle'
    ];

    public function locale(): BelongsTo
    {
        return $this->belongsTo(Locale::class);
    }

    public function catalogueCategory(): BelongsTo
    {
        return $this->belongsTo(CatalogueCategory::class);
    }

    public function catalogueCategoryByOrder(): BelongsTo
    {
        return $this->belongsTo(CatalogueCategory::class, 'catalogue_category_id')
            ->orderBy('parent', 'ASC')
            ->orderBy('position', 'ASC');
    }
}
