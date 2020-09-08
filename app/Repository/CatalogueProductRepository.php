<?php


namespace App\Repository;

use App\Entity\CatalogueCategory;
use App\Entity\CatalogueCategoryLocale;
use App\Entity\CatalogueProduct;
use App\Entity\CatalogueProductFloat;
use App\Entity\CatalogueProductLocale;
use App\Entity\CatalogueProductMedia;
use App\Entity\Store;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CatalogueProductRepository
{
    /**
     * @var CatalogueProduct
     */
    private $catalogueProduct;

    /**
     * CatalogueProductRepository constructor.
     * @param CatalogueProduct $catalogueProduct
     */
    public function __construct(CatalogueProduct $catalogueProduct)
    {
        $this->catalogueProduct = $catalogueProduct;
    }


    public function getAll(): Collection
    {
        return $this->catalogueProduct::all();
    }

    public function getAllWithLocales(): Collection
    {
        return $this->catalogueProduct::with('locales')->get();
    }

    public function getOne(int $id): CatalogueProduct
    {
        return $this->catalogueProduct::find($id)->first();
    }

    public function getOneWithLocales(int $id)
    {
        return $this->catalogueProduct::whereId($id)
            ->with(
                'locales',
                'locales.locale',
                'catalogueProductFloats',
                'catalogueProductMedias'
            )->first();
    }

//    public function getAllBycategory(int $id): Collection
//    {
//        return $this->catalogueProduct::with('categories')->get();
//    }

    public function store(array $datas): void
    {
        if (is_null($datas['product_id'])) {
            $product = new CatalogueProduct();
        } else {
            $product = CatalogueProduct::whereId($datas['product_id'])->first();
        }
        $product->allergy = $datas['allergy'];
        if (isset($datas['homemade']) && !is_null($datas['homemade'])) {
            $product->homemade = $datas['homemade'];
        } else {
            $product->homemade = false;
        }

        if (isset($datas['store_id']) && !is_null($datas['store_id'])) {
            $product->visibility = 'local';
        }

        $product->save();

        if (isset($datas['store_id']) && !is_null($datas['store_id'])) {
            $store = Store::whereId($datas['store_id'])->first();
            $product->stores()->sync([$store->id]);
        }

        $lastId = $product->id;


        foreach ($datas['locale'] as $localeID => $values) {
            $productLocale = new CatalogueProductLocale();
            foreach ($values as $field => $value) {
                $productLocale->$field = $value;
            }

            $productLocale->locale_id = $localeID;
            $productLocale->product_id = $lastId;
            $productLocale->save();
        }

        if (isset($datas['category']) && !is_null($datas['category'])) {
            foreach ($datas['category'] as $value) {
                $category = CatalogueCategory::whereId($value)->first();

                $product->categories()->sync([$category->id], false);
            }
        }


        if (is_null($datas['product_id'])) {
            $productFloats = new CatalogueProductFloat();
        } else {
            $productFloats = CatalogueProductFloat::whereProductId($datas['product_id'])->first();
        }

        foreach ($datas['float'] as $field => $value) {
            $productFloats->$field = $value;
        }

        $productFloats->product_id = $lastId;

        $productFloats->save();

        if (isset($datas['image']) && !is_null($datas['image'])) {
            foreach ($datas['image'] as $key => $file) {
                $productMedia = new CatalogueProductMedia();
                $productMedia->path = $file->getClientOriginalName();
                $productMedia->position = $key;
                $productMedia->product_id = $product->id;
                $productMedia->save();
            }
        }
    }

    public function trash(int $id): void
    {
        $product = CatalogueProduct::find($id);
        $product->delete();
    }
}
