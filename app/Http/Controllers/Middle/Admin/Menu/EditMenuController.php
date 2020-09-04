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

    private UserFonctionRepository $userFonctionRepository;

    private StoreRepository $storeRepository;

    private CatalogueProductRepository  $productRepository;

    private CatalogueCategoryRepository $catalogueCategoryRepository;

    private CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository;

    private LocaleRepository $localeRepository;

    public function __construct(
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository,
        CatalogueProductRepository $productRepository,
        CatalogueCategoryRepository $catalogueCategoryRepository,
        UserRepository $userRepository,
        LocaleRepository $localeRepository,
        CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository
    ) {
        parent::__construct($userFonctionRepository, $storeRepository);
        $this->productRepository = $productRepository;
        $this->catalogueCategoryRepository = $catalogueCategoryRepository;
        $this->userRepository = $userRepository;
        $this->localeRepository = $localeRepository;
        $this->catalogueCategoryLocaleRepository = $catalogueCategoryLocaleRepository;
    }

    public function __invoke(int $categoryId, int $productId)
    {
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
        $locales = $this->localeRepository->getAll();
        $category = $this->catalogueCategoryRepository->getOneWithAllProductsById($categoryId, 'fr');
        $subCategories = $this->catalogueCategoryLocaleRepository->getAllSubCategoriesByIdCategory($category->id);

//        dd($categoryId, $productId, $category);

        return view('admin.middle.menu.admin_middle_add_to_menu', [
            'stores' => $stores,
            'userFonctions' => $this->userFonctions,
            'category' => $category,
            'subcategories' => $subCategories,
            'locales' => $locales
        ]);

    }
}
