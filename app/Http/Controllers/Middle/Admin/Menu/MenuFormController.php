<?php


namespace App\Http\Controllers\Middle\Admin\Menu;


use App\Http\Controllers\Middle\AdminMiddleController;
use App\Repository\CatalogueCategoryLocaleRepository;
use App\Repository\LocaleRepository;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use function GuzzleHttp\Psr7\str;

class MenuFormController extends AdminMiddleController
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
     * @var LocaleRepository $localeRepository
     */
    private LocaleRepository $localeRepository;

    public function __construct(
        UserRepository $userRepository,
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository,
        CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository,
        LocaleRepository $localeRepository
    ) {
        parent::__construct($userFonctionRepository, $storeRepository);

        $this->userRepository = $userRepository;
        $this->catalogueCategoryLocaleRepository = $catalogueCategoryLocaleRepository;
        $this->localeRepository = $localeRepository;
    }

    public function show(string $slug) {
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
        $categories = $this->catalogueCategoryLocaleRepository->getAllWithCatalogueCategories();
        $locales = $this->localeRepository->getAll();
        $categoryInProgress = $this->catalogueCategoryLocaleRepository->getOneBySlug($slug);

        return view('admin.middle.menu.admin_middle_menu_creation', [
            'stores' => $stores,
            'userFonctions' => $this->userFonctions,
            'categories' => $categories,
            'locales' => $locales,
            'categoryInProgress' => $categoryInProgress
        ]);
    }

    public function store() {

        dd(request()->request, request()->file());
    }
}
