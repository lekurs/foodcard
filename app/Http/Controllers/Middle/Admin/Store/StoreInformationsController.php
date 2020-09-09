<?php


namespace App\Http\Controllers\Middle\Admin\Store;


use App\Http\Controllers\Middle\AdminMiddleController;
use App\Repository\StoreRepository;
use App\Repository\StoreTypeRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use Illuminate\View\View;

class StoreInformationsController extends AdminMiddleController
{
    private StoreRepository $storeRepository;

    private UserFonctionRepository $userFonctionRepository;

    private UserRepository $userRepository;

    private StoreTypeRepository $storeTypeRepository;

    public function __construct(
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository,
        UserRepository $userRepository,
        StoreTypeRepository $storeTypeRepository
    ) {
        parent::__construct($userFonctionRepository, $storeRepository, $userRepository);
        $this->userFonctionRepository = $userFonctionRepository;
        $this->storeRepository = $storeRepository;
        $this->userRepository = $userRepository;
        $this->storeTypeRepository = $storeTypeRepository;
    }

    public function __invoke($storeSlug): View
    {
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
        $storeTypes = $this->storeTypeRepository->getAll();
        $store = $this->storeRepository->getOneBySlug(session('store')->slug);
        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
                $medias[$mediasTab->type] = $mediasTab;
        }

        return view('admin.middle.store.admin_middle_store_update', [
            'store' => $store,
            'stores' => $stores,
            'medias' => $medias,
            'storeTypes' => $storeTypes,
        ]);
    }
}
