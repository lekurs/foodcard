<?php


namespace App\Http\Controllers\Middle\Admin;


use App\Http\Controllers\Controller;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminShowController extends Controller
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
     * AdminShowController constructor.
     *
     * @param StoreRepository $storeRepository
     * @param UserRepository $userRepository
     */
    public function __construct(StoreRepository $storeRepository, UserRepository $userRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->userRepository = $userRepository;
    }


    /**
     * @return View
     */
    public function show(): View
    {
        $user = $this->userRepository->getStoresByUser(request()->user());
        $stores = $user->stores;

        if (!request()->session()->get('store')) {
            request()->session()->put('store', $stores->first());
        }

        return view('admin.middle.admin_middle', [
            'stores' => $stores
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStore(): RedirectResponse
    {
        $store = $this->storeRepository->getOneBySlug(request()->request->get('changeStore'));

        session()->put('store', $store);

        return redirect()->back();
    }
}
