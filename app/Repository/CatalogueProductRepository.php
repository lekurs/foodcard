<?php


namespace App\Repository;


use App\Entity\CatalogueProduct;
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

    public function getOne(int $id): CatalogueProduct
    {
        return $this->catalogueProduct::find($id)->first();
    }

    public function store(array $datas): void
    {

    }
}
