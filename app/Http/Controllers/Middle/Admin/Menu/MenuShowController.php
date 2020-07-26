<?php


namespace App\Http\Controllers\Middle\Admin\Menu;


use App\Http\Controllers\Controller;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;

class MenuShowController extends Controller
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    /**
     * @var UserFonctionRepository $userFonctionRepository
     */
    private UserFonctionRepository $userFonctionRepository;

    /**
     * @var StoreRepository $storeRepository
     */
    private StoreRepository $storeRepository;

    /**
     * MenuShowController constructor.
     * @param UserRepository $userRepository
     * @param UserFonctionRepository $userFonctionRepository
     * @param StoreRepository $storeRepository
     */
    public function __construct
    (
        UserRepository $userRepository,
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userFonctionRepository = $userFonctionRepository;
        $this->storeRepository = $storeRepository;
    }

    public function show() {
        $userFonctions = $this->userFonctionRepository->getAll();
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;

        return view('admin.middle.menu.admin_middle_menu_show', [
            'stores' => $stores,
            'userFonctions' => $userFonctions
        ]);
    }
}
