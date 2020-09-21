<?php


namespace App\Http\Controllers\Middle;


use App\Repository\StoreRepository;
use App\Repository\UserRepository;

trait SessionRedirection
{
    private StoreRepository $storeRepository;

    private UserRepository $userRepository;

    /**
     * SessionRedirection constructor.
     * @param StoreRepository $storeRepository
     * @param UserRepository $userRepository
     */
    public function __construct(StoreRepository $storeRepository, UserRepository $userRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->userRepository = $userRepository;
    }

    public function redirectNoSession()
    {
        $user = $this->userRepository->getStoresByUser(request()->user());
        $stores = $user->stores;

        if (!request()->session()->get('store')) {
            request()->session()->put('store', $stores->first());
        }
    }
}
