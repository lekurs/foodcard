<?php


namespace App\Services\QRCode\Headers;


use App\Repository\StoreRepository;

class HeadersData
{

    private $storeRepository;

    /**
     * HeadersData constructor.
     * @param $storeRepository
     */
    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function __invoke()
    {
        $store = $this->storeRepository->getOneBySlug(session('store')->slug);
        $medias = [];
        $pageId = "store";
        $textPage = "mon établissement";

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        return [$store, $medias];
    }
}
