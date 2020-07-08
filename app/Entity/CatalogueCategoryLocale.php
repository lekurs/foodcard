<?php


namespace App\Entity;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogueCategoryLocale extends Model
{
    protected $fillable = [
      'libelle'
    ];

//    protected $primaryKey = ['locale_id', 'catalogue_category_id'];
//
//    protected function setKeysForSaveQuery(Builder $query)
//    {
//        return $query->where('locale_id', $this->getAttribute('locale_id'))
//            ->where('catalogue_category_id', $this->getAttribute('catalogue_category_id'));
//    }

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
