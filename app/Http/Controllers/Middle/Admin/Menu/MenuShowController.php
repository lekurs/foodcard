<?php


namespace App\Http\Controllers\Middle\Admin\Menu;


use App\Http\Controllers\Middle\AdminMiddleController;
use App\Repository\CatalogueCategoryLocaleRepository;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\DB;

class MenuShowController extends AdminMiddleController
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    /**
     * @var CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository
     */
    private CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository;

    /**
     * @var CatalogueCategoryRepository $catalogueCategoryRepository
     */
    private CatalogueCategoryRepository $catalogueCategoryRepository;

    public function __construct(
        UserRepository $userRepository,
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository,
        CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository,
        CatalogueCategoryRepository $catalogueCategoryRepository
    ) {
        parent::__construct($userFonctionRepository, $storeRepository);

        $this->userRepository = $userRepository;
        $this->catalogueCategoryLocaleRepository = $catalogueCategoryLocaleRepository;
        $this->catalogueCategoryRepository = $catalogueCategoryRepository;
    }

    public function show() {
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
        $categories = $this->catalogueCategoryLocaleRepository->getCategoriesLabelNoParent();

        return view('admin.middle.menu.admin_middle_menu_show', [
            'stores' => $stores,
            'userFonctions' => $this->userFonctions,
            'categories' => $categories,
        ]);
    }

    public function showSubCategories() {
        $id = request()->request->get('id');
        $subCategories = $this->catalogueCategoryLocaleRepository->getAllSubCategoriesByIdCategory($id);

        return view('admin.middle.menu.admin_middle_menu_subcategory', [
            'subCategories' => $subCategories,
        ]);
    }

    public function showProductsTable() {
        $id = request()->request->get('id');

        $category = $this->catalogueCategoryLocaleRepository->getOneByIdWithProducts($id);

        return view('admin.middle.menu.admin_middle_menu_products_table', [
            'category' => $category,
        ]);
    }

    public function search() {
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;

        return view('admin.middle.menu.admin_middle_menu_search', [
           'stores' => $stores,
            'userFonctions' => $this->userFonctions
        ]);
    }
}
