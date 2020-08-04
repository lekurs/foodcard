<?php


namespace App\Http\Controllers\Admin\Product;


use App\Entity\Locale;
use App\Http\Controllers\Controller;
use App\Repository\CatalogueCategoryLocaleRepository;
use App\Repository\CatalogueProductLocaleRepository;
use App\Repository\CatalogueProductRepository;
use App\Repository\LocaleRepository;
use App\Requests\Catalogue\Product\ProductCreation;
use Illuminate\View\View;

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
     * @var CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository
     */
    private CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository;

    /**
     * CatalogueProductFormController constructor.
     * @param CatalogueProductLocaleRepository $catalogueProductLocaleRepository
     * @param CatalogueProductRepository $catalogueProductRepository
     * @param CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository
     */
    public function __construct(
        CatalogueProductLocaleRepository $catalogueProductLocaleRepository,
        CatalogueProductRepository $catalogueProductRepository,
        CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository
    ) {
        $this->catalogueProductLocaleRepository = $catalogueProductLocaleRepository;
        $this->catalogueProductRepository = $catalogueProductRepository;
        $this->catalogueCategoryLocaleRepository = $catalogueCategoryLocaleRepository;
    }


    public function store(ProductCreation $validator)
    {
        $datas = $validator->all();

        $this->catalogueProductRepository->store($datas);

        return back()->with('success', 'Produit crée');
    }

    public function formProductUpdate()
    {
        if(request()->request->get('id') != "") {
            $product = $this->catalogueProductRepository->getOneWithLocales(request()->request->get('id'));
        }

        $locales = Locale::all();
        $categories = $this->catalogueCategoryLocaleRepository->getAllWithCatalogueCategories();

        if(request()->request->get('id') != "") {
            $allergy = explode('|' , $product->allergy);
            $html = \view('forms.products.__product_creation', [
                'product' => $product,
                'locales' => $locales,
                'allergy' => $allergy,
                'categories' => $categories
            ]);
        } else {
            $html = \view('forms.products.__product_creation', [
                'locales' => $locales,
                'categories' => $categories
            ]);
        }


        echo $html;
    }
}
