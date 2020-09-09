<?php


namespace App\Http\Controllers\Middle\Admin\Menu;


use App\Entity\CatalogueCategoryLocale;
use App\Http\Controllers\Middle\AdminMiddleController;
use App\Repository\CatalogueCategoryLocaleRepository;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\CatalogueProductRepository;
use App\Repository\LocaleRepository;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use App\Requests\Catalogue\Product\ProductCreation;
use Illuminate\Support\Str;
use function GuzzleHttp\Psr7\str;

class MenuFormController extends AdminMiddleController
{
    private UserRepository $userRepository;

    private CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository;

    private LocaleRepository $localeRepository;

    private CatalogueCategoryRepository $catalogueCategoryRepository;

    private CatalogueProductRepository $catalogueProductRepository;

    private StoreRepository $storeRepository;

    public function __construct(
        UserRepository $userRepository,
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository,
        CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository,
        LocaleRepository $localeRepository,
        CatalogueProductRepository $catalogueProductRepository

    ) {
        parent::__construct($userFonctionRepository, $storeRepository, $userRepository);

        $this->userRepository = $userRepository;
        $this->catalogueCategoryLocaleRepository = $catalogueCategoryLocaleRepository;
        $this->localeRepository = $localeRepository;
        $this->catalogueProductRepository = $catalogueProductRepository;
        $this->storeRepository = $storeRepository;
    }

    public function show(string $slug) {
        $category = $this->catalogueCategoryLocaleRepository->getOneBySlug($slug);
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
        $categories = $this->catalogueCategoryLocaleRepository->getCategoriesLabelNoParent();
        $locales = $this->localeRepository->getAll();
        $subCategories = $this->catalogueCategoryLocaleRepository->getAllSubCategoriesByIdCategory($category->catalogue_category_id);

        $store = $this->storeRepository->getOneBySlug(session('store')->slug);
        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        return view('admin.middle.menu.admin_middle_menu_creation', [
            'stores' => $stores,
            'store' => $store,
            'medias' => $medias,
            'userFonctions' => $this->userFonctions,
            'categories' => $categories,
            'locales' => $locales,
            'subcategories' => $subCategories,
            'category' => $category
        ]);
    }

    public function store(ProductCreation $validator) {

        $validates = $validator->all();

        $this->catalogueProductRepository->store($validates);

        if (isset($validates['image'])) {
            foreach ($validates['image'] as $file) {

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

        if (request()->get('productId')) {
            return redirect()->route('editMenu', request()->get('categoryId'));
        }

        return back()->with('success', 'Produit ajouté');

    }
}
