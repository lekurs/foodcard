<?php


namespace App\Repository;


use App\Entity\StoreMedia;

class StoreMediaRepository
{
    private StoreMedia $storeMedia;

    /**
     * StoreMediaRepository constructor.
     * @param StoreMedia $storeMedia
     */
    public function __construct(StoreMedia $storeMedia)
    {
        $this->storeMedia = $storeMedia;
    }

    public function store(array $datas): void
    {
//        if (isset($datas['store_id'])) {
//            $storeMedia = $this->storeMedia::whereStoreId($datas['store_id'])->first();
//        }
    }
}
