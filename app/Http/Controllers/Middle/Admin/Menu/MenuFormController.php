<?php


namespace App\Http\Controllers\Middle\Admin\Menu;


use App\Http\Controllers\Middle\AdminMiddleController;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;

class MenuFormController extends AdminMiddleController
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository, UserFonctionRepository $userFonctionRepository, StoreRepository $storeRepository)
    {
        parent::__construct($userFonctionRepository, $storeRepository);

        $this->userRepository = $userRepository;
    }

    public function show() {
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;

        return view('admin.middle.menu.admin_middle_menu_creation', [
            'stores' => $stores,
            'userFonctions' => $this->userFonctions
        ]);
    }
}
