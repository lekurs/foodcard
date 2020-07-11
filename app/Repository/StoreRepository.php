<?php


namespace App\Repository;


use App\Entity\Store;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class StoreRepository
{
    /**
     * @var Store $store
     */
    private $store;

    /**
     * @var int
     */
    protected $limitPerPage = 12;

    /**
     * StoreRepository constructor.
     * @param Store $store
     */
    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function getAll(): Collection
    {
        return $this->store::all();
    }

    public function getAllWithTypes()
    {
        return $this->store::with('storeType')->paginate(12);
    }

    public function getAllWithTypesByName(string $name)
    {
        return $this->store::with('storeType')->where('name', 'like', '%' . $name . '%')->paginate(12);
    }

    public function getAllWithTypesByType(int $typeId)
    {
        return $this->store::with('storeType')->where('store_type_id', '=', $typeId)->paginate(12);
    }

    public function getAllWithTypesByTypeAndName(string $name, int $typeId)
    {
        return $this->store::with('storeType')
            ->where('name', 'like', '%' . $name . '%')
            ->where('store_type_id', '=', $typeId)
            ->paginate(12);
    }

//    public function getOneByUserId($userId)
//    {
////        ->where('user_id', '=', $userId)
//        return Store::with('users')->get();
//    }
}
