<?php


namespace App\Http\Controllers\Admin\Product;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueCategoryLocaleRepository;
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
     * @var CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository
     */
    private CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository;

    /**
     * CatalogueProductShowController constructor.
     * @param CatalogueProductRepository $catalogueProductRepository
     * @param LocaleRepository $localeRepository
     * @param CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository
     */
    public function __construct(
        CatalogueProductRepository $catalogueProductRepository,
        LocaleRepository $localeRepository,
        CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository
    ) {
        $this->catalogueProductRepository = $catalogueProductRepository;
        $this->localeRepository = $localeRepository;
        $this->catalogueCategoryLocaleRepository = $catalogueCategoryLocaleRepository;
    }


    public function show(): View
    {
        $products = $this->catalogueProductRepository->getAllWithLocales();
        $locales = $this->localeRepository->getAll();
        $categories = $this->catalogueCategoryLocaleRepository->getAllWithCatalogueCategories();

        return \view('admin.product.catalogue_product_show', [
            'products' => $products,
            'locales' => $locales,
            'categories' => $categories
        ]);
    }
}
