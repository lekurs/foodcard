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

    /**
     * AdminShowController constructor.
     * @param StoreRepository $storeRepository
     */
    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }


    public function show(): View
    {
//        $store = $this->storeRepository->getOneByUserId(auth()->user()->id);
//
//        dd($store);

        return view('admin.middle.admin_middle', [
//            'store' => $store
        ]);
    }
}
