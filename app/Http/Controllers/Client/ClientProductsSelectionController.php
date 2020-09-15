<?php


namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\StoreRepository;

class ClientProductsSelectionController extends Controller
{
    private StoreRepository $storeRepository;

    private CatalogueCategoryRepository $catalogueCategoryRepository;

    /**
     * StoreHomeController constructor.
     * @param StoreRepository $storeRepository
     * @param CatalogueCategoryRepository $catalogueCategoryRepository
     */
    public function __construct(
        StoreRepository $storeRepository,
        CatalogueCategoryRepository $catalogueCategoryRepository
    ) {
        $this->storeRepository = $storeRepository;
        $this->catalogueCategoryRepository = $catalogueCategoryRepository;
    }

    public function __invoke(string $storeSlug, int $subcategoryId)
    {
//        dd(request('subcategoryId'));
        $store = $this->storeRepository->getOneBySlug($storeSlug);
        $categories = $this->catalogueCategoryRepository->getAllMainCategories();
        $category = $this->catalogueCategoryRepository->getOneByIdWithAllProductsOnlineByStore(request('subcategoryId'), $store->id);
        $subcategory = $this->catalogueCategoryRepository->getOneWithLocalesById(request('subcategoryId'));

        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        return view('client.api_product_selection', [
            'store' => $store,
            'medias' => $medias,
            'categories' => $categories,
            'category' => $category,
            'subcategory' => $subcategory
        ]);
    }
}
