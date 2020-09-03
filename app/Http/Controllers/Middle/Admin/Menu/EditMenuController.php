<?php


namespace App\Http\Controllers\Middle\Admin\Menu;

use App\Http\Controllers\Middle\AdminMiddleController;
use App\Repository\CatalogueProductRepository;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;

class EditMenuController extends AdminMiddleController
{
    private UserFonctionRepository $userFonctionRepository;

    private StoreRepository $storeRepository;

    private CatalogueProductRepository  $productRepository;

    public function __construct(
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository,
        CatalogueProductRepository $productRepository
    ) {
        parent::__construct($userFonctionRepository, $storeRepository);
        $this->productRepository = $productRepository;
    }

    public function __invoke(int $productId)
    {
        dd($productId);
    }
}
