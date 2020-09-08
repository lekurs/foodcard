<?php


namespace App\Http\Controllers\Middle\Admin\Menu;


use App\Entity\CatalogueProduct;
use App\Http\Controllers\Middle\AdminMiddleController;
use App\Repository\CatalogueProductRepository;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use Illuminate\Http\JsonResponse;

class CreateOnlineMenuController extends AdminMiddleController
{

    private StoreRepository $storeRepository;

    private CatalogueProductRepository $catalogueProductRepository;

    public function __construct(
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository,
        CatalogueProductRepository $catalogueProductRepository
    ) {
        parent::__construct($userFonctionRepository, $storeRepository);
        $this->storeRepository = $storeRepository;
        $this->catalogueProductRepository = $catalogueProductRepository;
    }

    public function updateOnline(): JsonResponse
    {
        $product = CatalogueProduct::whereId(intval(request()->get('idProduct')))->first();

        $this->storeRepository->setOnlineProductByStore($product);

        return response()->json('success');
    }
}
