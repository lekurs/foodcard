<?php


namespace App\Http\Controllers\Admin\Product;


use App\Entity\Locale;
use App\Http\Controllers\Controller;
use App\Repository\AllergyRepository;
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

    private AllergyRepository $allergyRepository;

    /**
     * CatalogueProductFormController constructor.
     * @param CatalogueProductLocaleRepository $catalogueProductLocaleRepository
     * @param CatalogueProductRepository $catalogueProductRepository
     * @param CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository
     * @param AllergyRepository $allergyRepository
     */
    public function __construct(
        CatalogueProductLocaleRepository $catalogueProductLocaleRepository,
        CatalogueProductRepository $catalogueProductRepository,
        CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository,
        AllergyRepository $allergyRepository
    ) {
        $this->catalogueProductLocaleRepository = $catalogueProductLocaleRepository;
        $this->catalogueProductRepository = $catalogueProductRepository;
        $this->catalogueCategoryLocaleRepository = $catalogueCategoryLocaleRepository;
        $this->allergyRepository = $allergyRepository;
    }


    public function store(ProductCreation $validator)
    {
        $datas = $validator->all();

        $this->catalogueProductRepository->store($datas);

        if (isset($datas['image'])) {
            foreach ($datas['image'] as $file) {

                $mimeTypes = ['image/png', 'image/jpeg', 'image/gif', 'image/svg+xml'];

                if ($file->getError() !== 0) {

                    return back()->with('error', request()->file()->getErrorMessage());
                }

                if (!in_array($file->getMimeType(), $mimeTypes)) {

                    return back()->with('error', 'Pas le bon format de fichier');
                }

                $file->storeAs('/public/products/', $file->getClientOriginalName());
            }
        }

        return back()->with('success', 'Produit crée');
    }

    public function formProductUpdate()
    {
        if(request()->request->get('id') != "") {
            $product = $this->catalogueProductRepository->getOneWithLocales(request()->request->get('id'));
        }

        $locales = Locale::all();
        $catalogueCategories = $this->catalogueCategoryLocaleRepository->getAllWithCatalogueCategories();
        $allergies = $this->allergyRepository->getAll();

        if(request()->request->get('id') != "") {
            $allergyByProduct = explode('|', $product->allergy);
            $allergies = $this->allergyRepository->getAll();

            $html = \view('forms.products.__product_creation', [
                'product' => $product,
                'locales' => $locales,
                'allergies' => $allergies,
                'categories' => $catalogueCategories,
                'allergyByProduct' => $allergyByProduct
            ]);
        } else {
            $html = \view('forms.products.__product_creation', [
                'locales' => $locales,
                'categories' => $catalogueCategories,
                'allergies' => $allergies
            ]);
        }

        echo $html;
    }
}
