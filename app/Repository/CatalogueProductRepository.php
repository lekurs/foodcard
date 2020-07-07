<?php


namespace App\Repository;


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
        return $this->catalogueProduct::with('catalogueProductLocales')->get();
    }

    public function getOne(int $id): CatalogueProduct
    {
        return $this->catalogueProduct::find($id)->first();
    }

    public function store(array $datas): void
    {
        $product = new CatalogueProduct();
        $product->allergy = $datas['allergy'];
        $product->save();
        $lastId = $product->id;

        foreach($datas['locale'] as $localeID => $values) {
            $productLocale = new CatalogueProductLocale();
                foreach($values as $field => $value) {
                    $productLocale->$field = $value;
                }
            $productLocale->locale_id = $localeID;
            $productLocale->product_id = $lastId;
            $productLocale->save();
        }

        $productFloats = new CatalogueProductFloat();
            foreach ($datas['float'] as $field => $value) {
                $productFloats->$field = $value;

            }
        $productFloats->product_id = $lastId;
        $productFloats->save();
    }
}
