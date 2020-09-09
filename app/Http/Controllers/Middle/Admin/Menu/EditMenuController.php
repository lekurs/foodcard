<?php


namespace App\Http\Controllers\Middle\Admin\Menu;

use App\Http\Controllers\Middle\AdminMiddleController;
use App\Repository\CatalogueCategoryLocaleRepository;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\CatalogueProductRepository;
use App\Repository\LocaleRepository;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;

class EditMenuController extends AdminMiddleController
{
    private UserRepository $userRepository;

    private StoreRepository $storeRepository;

    private CatalogueProductRepository  $productRepository;

    private CatalogueCategoryRepository $catalogueCategoryRepository;

    private CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository;

    private LocaleRepository $localeRepository;

    public function __construct(
        UserFonctionRepository $userFonctionRepository,
        CatalogueProductRepository $productRepository,
        CatalogueCategoryRepository $catalogueCategoryRepository,
        UserRepository $userRepository,
        LocaleRepository $localeRepository,
        StoreRepository $storeRepository,
        CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository
    ) {
        parent::__construct($userFonctionRepository, $storeRepository, $userRepository);
        $this->productRepository = $productRepository;
        $this->catalogueCategoryRepository = $catalogueCategoryRepository;
        $this->userRepository = $userRepository;
        $this->localeRepository = $localeRepository;
        $this->catalogueCategoryLocaleRepository = $catalogueCategoryLocaleRepository;
        $this->storeRepository = $storeRepository;
    }

    public function __invoke(int $categoryId, int $productId = null)
    {
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
        $locales = $this->localeRepository->getAll();
        $category = $this->catalogueCategoryRepository->getOneWithAllProductsById($categoryId, 'fr');
        $subCategories = $this->catalogueCategoryLocaleRepository->getAllSubCategoriesByIdCategory($category->id);
        $store = $this->storeRepository->getOneBySlug(session('store')->slug);
        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }


        return view('admin.middle.menu.admin_middle_add_to_menu', [
            'stores' => $stores,
            'store' => $store,
            'medias' => $medias,
            'userFonctions' => $this->userFonctions,
            'category' => $category,
            'subcategories' => $subCategories,
            'locales' => $locales
        ]);
    }
}
