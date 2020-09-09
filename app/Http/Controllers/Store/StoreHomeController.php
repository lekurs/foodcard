<?php


namespace App\Http\Controllers\Store;


use App\Http\Controllers\Controller;
use App\Repository\StoreRepository;

class StoreHomeController extends Controller
{
    private StoreRepository $storeRepository;

    /**
     * StoreHomeController constructor.
     * @param StoreRepository $storeRepository
     */
    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }


    public function __invoke(string $storeSlug)
    {
        $store = $this->storeRepository->getOneBySlug($storeSlug);
        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        return view('api.api_index', [
            'store' => $store,
            'medias' => $medias
        ]);
    }
}
