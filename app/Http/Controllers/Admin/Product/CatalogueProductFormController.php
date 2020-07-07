<?php


namespace App\Http\Controllers\Admin\Product;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueProductLocaleRepository;
use App\Repository\CatalogueProductRepository;
use App\Requests\Catalogue\Product\ProductCreation;

class CatalogueProductFormController extends Controller
{
    /**
     * @var CatalogueProductLocaleRepository
     */
    private $catalogueProductLocaleRepository;

    /**
     * @var CatalogueProductRepository
     */
    private $catalogueProductRepository;

    /**
     * CatalogueProductFormController constructor.
     * @param CatalogueProductLocaleRepository $catalogueProductLocaleRepository
     * @param CatalogueProductRepository $catalogueProductRepository
     */
    public function __construct(CatalogueProductLocaleRepository $catalogueProductLocaleRepository, CatalogueProductRepository $catalogueProductRepository)
    {
        $this->catalogueProductLocaleRepository = $catalogueProductLocaleRepository;
        $this->catalogueProductRepository = $catalogueProductRepository;
    }


    public function store(ProductCreation $validator)
    {
        $datas = $validator->all();

        $this->catalogueProductRepository->store($datas);

//        $this->catalogueProductLocaleRepository->store($validates);

        return back()->with('success', 'Produit crée');
    }
}
