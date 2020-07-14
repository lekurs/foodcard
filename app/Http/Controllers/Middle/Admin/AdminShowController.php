<?php


namespace App\Http\Controllers\Middle\Admin;


use App\Http\Controllers\Controller;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use Illuminate\View\View;

class AdminShowController extends Controller
{
    /**
     * @var StoreRepository $storeRepository
     */
    private StoreRepository $storeRepository;

    private UserRepository $userRepository;

    /**
     * AdminShowController constructor.
     * @param StoreRepository $storeRepository
     * @param UserRepository $userRepository
     */
    public function __construct(StoreRepository $storeRepository, UserRepository $userRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->userRepository = $userRepository;
    }


    public function show(): View
    {
        $user = $this->userRepository->getStoresByUser(auth()->user());
        $stores = $user->stores;

        return view('admin.middle.admin_middle', [
            'stores' => $stores
        ]);
    }
}
