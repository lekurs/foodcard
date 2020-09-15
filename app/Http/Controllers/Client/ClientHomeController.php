<?php


namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\StoreRepository;

class ClientHomeController extends Controller
{
    private StoreRepository $storeRepository;

    private CatalogueCategoryRepository $catalogueCategoryRepository;

    /**
     * StoreHomeController constructor.
     * @param StoreRepository $storeRepository
     * @param CatalogueCategoryRepository $catalogueCategoryRepository
     */
    public function __construct(StoreRepository $storeRepository, CatalogueCategoryRepository $catalogueCategoryRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->catalogueCategoryRepository = $catalogueCategoryRepository;
    }


    public function __invoke(string $storeSlug)
    {
        $store = $this->storeRepository->getOneBySlug($storeSlug);
        $categories = $this->catalogueCategoryRepository->getAllMainCategories();
        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        return view('client.api_index', [
            'store' => $store,
            'medias' => $medias,
            'categories' => $categories
        ]);
    }
}
