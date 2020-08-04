<?php


namespace App\Repository;


use App\Entity\CatalogueCategory;
use App\Entity\CatalogueCategoryLocale;
use App\Entity\CatalogueProduct;
use App\Entity\CatalogueProductFloat;
use App\Entity\CatalogueProductLocale;
use Illuminate\Database\Eloquent\Collection;

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
        return $this->catalogueProduct::whereId($id)->with('locales')->with('catalogueProductFloats')->first();
    }

    public function store(array $datas): void
    {
        if (is_null($datas['product_id'])) {

            $product = new CatalogueProduct();
            $product->allergy = $datas['allergy'];
            $product->save();
            $lastId = $product->id;

            foreach($datas['locale'] as $localeID => $values) {
                $productLocale = new CatalogueProductLocale();
                foreach($values as $field => $value) {
                    $productLocale->$field = $value;
                }

                $productLocale->homemade = $datas['homemade'];
                $productLocale->locale_id = $localeID;
                $productLocale->product_id = $lastId;
                $productLocale->save();
            }

            foreach ($datas['category'] as $value) {
                $category = CatalogueCategoryLocale::whereId($value)->first();

                $product->categoriesLocale()->sync([$category->id]);
            }

            $productFloats = new CatalogueProductFloat();
            foreach ($datas['float'] as $field => $value) {
                $productFloats->$field = $value;

            }
            $productFloats->product_id = $lastId;
            $productFloats->save();

        } else {
            //On update
            $product = CatalogueProduct::whereId($datas['product_id'])->first();
            $product->allergy = $datas['allergy'];
            $product->save();
            $lastId = $datas['product_id'];

            foreach($datas['locale'] as $localeID => $values) {
                $productLocale = CatalogueProductLocale::whereProductId($datas['product_id'])->whereLocaleId($localeID)->first();
                foreach($values as $field => $value) {
                    $productLocale->$field = $value;
                }
                $productLocale->locale_id = $localeID;
                $productLocale->save();
            }

            $productFloats = CatalogueProductFloat::whereProductId($datas['product_id'])->first();
            foreach ($datas['float'] as $field => $value) {
                $productFloats->$field = $value;

            }
            $productFloats->save();
        }
    }

    public function trash(int $id): void
    {
        $product = CatalogueProduct::find($id);
        $product->delete();
    }
}
