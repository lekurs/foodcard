<?php


namespace App\Http\Controllers\Middle\Admin\Menu;


use App\Entity\CatalogueProduct;
use App\Http\Controllers\Middle\AdminMiddleController;
use App\Repository\CatalogueProductRepository;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;

class CreateOnlineMenuController extends AdminMiddleController
{

    private StoreRepository $storeRepository;

    private CatalogueProductRepository $catalogueProductRepository;

    private UserRepository $userRepository;

    public function __construct(
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository,
        CatalogueProductRepository $catalogueProductRepository,
        UserRepository $userRepository
    ) {
        parent::__construct($userFonctionRepository, $storeRepository, $userRepository);
        $this->storeRepository = $storeRepository;
        $this->catalogueProductRepository = $catalogueProductRepository;
        $this->userRepository = $userRepository;
    }

    public function updateOnline(): JsonResponse
    {
        $product = CatalogueProduct::whereId(intval(request()->get('idProduct')))->first();

        $this->storeRepository->setOnlineProductByStore($product);

        return response()->json('success');
    }
}
