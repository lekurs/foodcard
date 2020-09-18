<?php


namespace App\Http\Controllers\Middle\Admin\Menu;


use App\Http\Controllers\Middle\AdminMiddleController;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\CatalogueCategoryLocaleRepository;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\CatalogueProductRepository;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class MenuShowController extends AdminMiddleController
{
    use SessionRedirection;

    private UserRepository $userRepository;

    private CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository;

    private CatalogueCategoryRepository $catalogueCategoryRepository;

    private CatalogueProductRepository $catalogueProductRepository;

    private StoreRepository $storeRepository;

    public function __construct(
        UserRepository $userRepository,
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository,
        CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository,
        CatalogueCategoryRepository $catalogueCategoryRepository,
        CatalogueProductRepository $catalogueProductRepository
    ) {
        parent::__construct($userFonctionRepository, $storeRepository, $userRepository);

        $this->userRepository = $userRepository;
        $this->catalogueCategoryLocaleRepository = $catalogueCategoryLocaleRepository;
        $this->catalogueCategoryRepository = $catalogueCategoryRepository;
        $this->catalogueProductRepository = $catalogueProductRepository;
        $this->storeRepository = $storeRepository;
    }

    public function showMenu() {
        $this->redirectNoSession();

        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
        $store = $this->storeRepository->getOneBySlug(session('store')->slug);
        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        $starters = $this->catalogueCategoryRepository->getOneWithAllProductsOnlyLocalByIdAndByStore(5);
        $mainDishes = $this->catalogueCategoryRepository->getOneWithAllProductsOnlyLocalByIdAndByStore(6);
        $deserts = $this->catalogueCategoryRepository->getOneWithAllProductsOnlyLocalByIdAndByStore(1);
        $drinks = $this->catalogueCategoryRepository->getOneWithAllProductsOnlyLocalByIdAndByStore(7);

        return view('admin.middle.menu.admin_middle_show_menu', [
            'stores' => $stores,
            'store' => $store,
            'medias' => $medias,
            'userFonctions' => $this->userFonctions,
            'starters' => $starters,
            'mainDishes' => $mainDishes,
            'deserts' => $deserts,
            'drinks' => $drinks
        ]);
    }

    //TODO : DELETE ALL METHOS UNDER THIS ONE
//    public function show() {
//        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
//        $categories = $this->catalogueCategoryLocaleRepository->getCategoriesLabelNoParent();
//
//        return view('admin.middle.menu.admin_middle_menu_show', [
//            'stores' => $stores,
//            'userFonctions' => $this->userFonctions,
//            'categories' => $categories,
//        ]);
//    }
//
//    public function showSubCategories() {
//        $id = request()->request->get('id');
//        $subCategories = $this->catalogueCategoryLocaleRepository->getAllSubCategoriesByIdCategory($id);
//
//        return view('admin.middle.menu.admin_middle_menu_subcategory', [
//            'subCategories' => $subCategories,
//        ]);
//    }
//
//    public function showProductsTable() {
//        $id = request()->request->get('id');
//
//        $category = $this->catalogueCategoryRepository->getOneWithLocalesById($id);
//        $productList = $this->catalogueCategoryRepository->getAllProductsByCategory($id);
//
//        return view('admin.middle.menu.admin_middle_menu_products_table', [
//            'productList' => $productList,
//            'category' => $category
//        ]);
//    }
//
//    public function search() {
//        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
//
//        return view('admin.middle.menu.admin_middle_menu_search', [
//           'stores' => $stores,
//            'userFonctions' => $this->userFonctions
//        ]);
//    }
}
