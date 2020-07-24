<?php


namespace App\Http\Controllers\Middle\Admin\Store;


use App\Http\Controllers\Controller;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use Illuminate\View\View;

class StoreShowController extends Controller
{
    /**
     * @var StoreRepository
     */
    private StoreRepository $storeRepository;

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @var UserFonctionRepository $userFonctionRepository
     */
    private UserFonctionRepository $userFonctionRepository;

    /**
     * StoreShowController constructor.
     *
     * @param StoreRepository $storeRepository
     * @param UserRepository $userRepository
     * @param UserFonctionRepository $userFonctionRepository
     */
    public function __construct(
        StoreRepository $storeRepository,
        UserRepository $userRepository,
        UserFonctionRepository $userFonctionRepository
    ) {
        $this->storeRepository = $storeRepository;
        $this->userRepository = $userRepository;
        $this->userFonctionRepository = $userFonctionRepository;
    }


    public function show(): View
    {
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
        $userFonctions = $this->userFonctionRepository->getAll();
        $usersByStore = $this->storeRepository->getUsersByStore(request()->session()->get('store'));

        return view('admin.middle.store.admin_middle_store_show', [
            'stores' => $stores,
            'userFonctions' => $userFonctions,
            'usersByStore' => $usersByStore
        ]);
    }
}
