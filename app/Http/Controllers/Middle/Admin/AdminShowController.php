<?php


namespace App\Http\Controllers\Middle\Admin;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminShowController extends Controller
{
    use SessionRedirection;

    private StoreRepository $storeRepository;

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

        $this->redirectNoSession();

        $medias = [];

        foreach (session('store')->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        if (!request()->session()->get('store')) {
            request()->session()->put('store', $stores->first());
        }

        return view('admin.middle.admin_middle', [
            'stores' => $stores,
            'medias' => $medias
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
