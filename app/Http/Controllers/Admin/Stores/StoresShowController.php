<?php


namespace App\Http\Controllers\Admin\Stores;


use App\Http\Controllers\Controller;
use App\Repository\StoreRepository;
use App\Repository\StoreTypeRepository;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StoresShowController extends Controller
{
    /**
     * @var StoreRepository $storeRepository
     */
    private StoreRepository $storeRepository;

    /**
     * @var StoreTypeRepository
     */
    private StoreTypeRepository $storeTypeRepository;



    /**
     * StoresShowController constructor.
     *
     * @param StoreTypeRepository $storeTypeRepository
     * @param StoreRepository $storeRepository
     */
    public function __construct(StoreTypeRepository $storeTypeRepository, StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->storeTypeRepository = $storeTypeRepository;
    }

    public function show(): View
    {
        $stores = $this->storeRepository->getAllWithTypes();

//        dd(request()->query->get('search-shop'), request()->query->get('search-type'));
        if (request()->query->get('search-shop') && is_null(request()->query->get('search-type'))) {
            $stores = $this->storeRepository->getAllWithTypesByName(request()->query->get('search-shop'));
        }

        if(request()->query->get('search-type') && is_null(request()->query->get('search-shop'))) {
            $stores = $this->storeRepository->getAllWithTypesByType(request()->query->get('search-type'));
        }
        if (request()->query->get('search-type') && request()->query->get('search-shop')) {
            $stores = $this->storeRepository->getAllWithTypesByTypeAndName(request()->query->get('search-shop'), request()->query->get('search-type'));
        }

        $storeTypes = $this->storeTypeRepository->getAll();

        return view('admin.stores.store_show', [
            'stores' => $stores,
            'storeTypes' => $storeTypes,
        ]);
    }
}
