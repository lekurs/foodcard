<?php


namespace App\Repository;


use App\Entity\Store;
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
        $store = Store::whereId($datas['store_id'])->with('storeMedias')->first();

        if (empty($store->storeMedias->first())) {
            foreach($datas['storeMedias'] as $key => $uploadFile) {
                $storeMedia = new StoreMedia();
                $storeMedia->type = $key;
                $storeMedia->path = $uploadFile[0]->getClientOriginalName();
                $storeMedia->store_id = $datas['store_id'];
                $storeMedia->save();
            }

        }
    }
}
