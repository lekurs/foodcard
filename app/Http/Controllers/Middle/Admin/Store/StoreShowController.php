<?php


namespace App\Http\Controllers\Middle\Admin\Store;


use App\Http\Controllers\Controller;
use App\Repository\StoreRepository;
use Illuminate\View\View;

class StoreShowController extends Controller
{
    private StoreRepository $storeRepository;

    /**
     * StoreShowController constructor.
     *
     * @param StoreRepository $storeRepository
     */
    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }


    public function show(): View
    {
        return view('admin.middle.store.admin_middle_store_show', [

        ]);
    }
}
