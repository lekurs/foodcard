<?php


namespace App\Repository;


use App\Entity\StoreType;
use Illuminate\Database\Eloquent\Collection;

class StoreTypeRepository
{
    public function getAll(): Collection
    {
        return StoreType::all();
    }

    public function store(array $datas): void
    {
        if (!is_null($datas['id'])) {
            $storeType = StoreType::find($datas['id']);
            $storeType->type = $datas['store_type'];
            $storeType->save();
        } else {
            $storeType = new StoreType();
            $storeType->type = $datas['store_type'];
            $storeType->save();
        }
    }

    public function trash(int $id): void
    {
        StoreType::find($id)->delete();
    }
}
