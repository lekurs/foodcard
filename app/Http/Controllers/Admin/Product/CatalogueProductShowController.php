<?php


namespace App\Http\Controllers\Admin\Product;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueProductRepository;
use App\Repository\LocaleRepository;
use Illuminate\View\View;

class CatalogueProductShowController extends Controller
{
    /**
     * @var CatalogueProductRepository
     */
    private $catalogueProductRepository;

    /**
     * @var LocaleRepository
     */
    private $localeRepository;

    /**
     * CatalogueProductShowController constructor.
     * @param CatalogueProductRepository $catalogueProductRepository
     * @param LocaleRepository $localeRepository
     */
    public function __construct(CatalogueProductRepository $catalogueProductRepository, LocaleRepository $localeRepository)
    {
        $this->catalogueProductRepository = $catalogueProductRepository;
        $this->localeRepository = $localeRepository;
    }


    public function show(): View
    {
        $products = $this->catalogueProductRepository->getAll();
        $locales = $this->localeRepository->getAll();

        return \view('admin.product.catalogue_product_show', [
            'products' => $products,
            'locales' => $locales
        ]);
    }
}
