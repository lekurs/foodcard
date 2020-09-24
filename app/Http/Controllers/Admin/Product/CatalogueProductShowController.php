<?php


namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Repository\CatalogueCategoryLocaleRepository;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\CatalogueProductRepository;
use App\Repository\LocaleRepository;
use Illuminate\View\View;

class CatalogueProductShowController extends Controller
{

    private CatalogueProductRepository $catalogueProductRepository;

    private LocaleRepository $localeRepository;

    private CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository;

    private CatalogueCategoryRepository $catalogueCategoryRepository;

    /**
     * CatalogueProductShowController constructor.
     * @param CatalogueProductRepository $catalogueProductRepository
     * @param LocaleRepository $localeRepository
     * @param CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository
     * @param CatalogueCategoryRepository $catalogueCategoryRepository
     */
    public function __construct(
        CatalogueProductRepository $catalogueProductRepository,
        LocaleRepository $localeRepository,
        CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository,
        CatalogueCategoryRepository $catalogueCategoryRepository
    ) {
        $this->catalogueProductRepository = $catalogueProductRepository;
        $this->localeRepository = $localeRepository;
        $this->catalogueCategoryLocaleRepository = $catalogueCategoryLocaleRepository;
        $this->catalogueCategoryRepository = $catalogueCategoryRepository;
    }


    public function show(): View
    {
        $products = $this->catalogueProductRepository->getAllWithLocales();
        $locales = $this->localeRepository->getAll();
        $categories = $this->catalogueCategoryRepository->getAll();

        return \view('admin.product.catalogue_product_show', [
            'products' => $products,
            'locales' => $locales,
            'categories' => $categories,
        ]);
    }
}
