<?php


namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\CatalogueProductRepository;
use App\Repository\StoreRepository;

class ClientProductShowController extends Controller
{
    private StoreRepository $storeRepository;

    private CatalogueCategoryRepository $catalogueCategoryRepository;

    private CatalogueProductRepository $catalogueProductRepository;

    /**
     * StoreHomeController constructor.
     * @param StoreRepository $storeRepository
     * @param CatalogueCategoryRepository $catalogueCategoryRepository
     * @param CatalogueProductRepository $catalogueProductRepository
     */
    public function __construct(
        StoreRepository $storeRepository,
        CatalogueCategoryRepository $catalogueCategoryRepository,
        CatalogueProductRepository $catalogueProductRepository
    ) {
        $this->storeRepository = $storeRepository;
        $this->catalogueCategoryRepository = $catalogueCategoryRepository;
        $this->catalogueProductRepository = $catalogueProductRepository;
    }

    public function __invoke(string $storeSlug, int $categoryId, int $subCategoryId, int $productId)
    {

        $store = $this->storeRepository->getOneBySlug($storeSlug);
        $categories = $this->catalogueCategoryRepository->getAllMainCategories();
        $subcategory = $this->catalogueCategoryRepository->getOneWithLocalesById(request('subcategoryId'));
        $product = $this->catalogueProductRepository->getOneWithLocalesAndMediasById($productId);

//        dd($product);

        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        return view('client.api_product_show', [
            'store' => $store,
            'categories' => $categories,
            'subcategory' => $subcategory,
            'product' => $product
        ]);
    }
}
