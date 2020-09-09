<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use Illuminate\View\View;

class AccountShowController extends Controller
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
     * AccountShowController constructor.
     * @param UserRepository $userRepository
     * @param UserFonctionRepository $userFonctionRepository
     * @param StoreRepository $storeRepository
     */
    public function __construct(
        UserRepository $userRepository,
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userFonctionRepository = $userFonctionRepository;
        $this->storeRepository = $storeRepository;
    }


    public function show(): View
    {
        $userFonctions = $this->userFonctionRepository->getAll();
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
        $store = $this->storeRepository->getOneBySlug(session('store')->slug);
        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        return view('admin.middle.account.admin_middle_account_show', [
            'userFonctions' => $userFonctions,
            'stores' => $stores,
            'medias' => $medias,
            'store' => $store
        ]);
    }
}
