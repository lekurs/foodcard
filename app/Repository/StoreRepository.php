<?php


namespace App\Repository;


use App\Entity\CatalogueProduct;
use App\Entity\Store;
use App\Entity\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->store::all();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithTypes()
    {
        return $this->store::with('storeType')->paginate(12);
    }

    /**
     * @param string $name
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithTypesByName(string $name)
    {
        return $this->store::with('storeType')->where('name', 'like', '%' . $name . '%')->paginate(12);
    }

    /**
     * @param int $typeId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithTypesByType(int $typeId): LengthAwarePaginator
    {
        return $this->store::with('storeType')->where('store_type_id', '=', $typeId)->paginate(12);
    }

    /**
     * @param string $slug
     * @return Store
     */
    public function getOneBySlug(string $slug): Store
    {
        return $this->store::whereSlug($slug)->first();
    }

    /**
     * @param string $name
     * @param int $typeId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithTypesByTypeAndName(string $name, int $typeId): LengthAwarePaginator
    {
        return $this->store::with('storeType')
            ->where('name', 'like', '%' . $name . '%')
            ->where('store_type_id', '=', $typeId)
            ->paginate(12);
    }

    /**
     * @param Store $store
     * @return Store
     */
    public function getUsersByStore(Store $store): Store
    {
        return $this->store::with('users')->whereId($store->id)->first();
    }

    public function setOnlineProductByStore(CatalogueProduct $product): void
    {
        $online = $this->store->products()->newPivotStatement()->whereCatalogueProductId($product->id)->first()->online;

        $online > 0
            ?
            $this->store->products()->newPivotStatement()->whereCatalogueProductId($product->id)->update(['online' => false])
            :
            $this->store->products()->newPivotStatement()->whereCatalogueProductId($product->id)->update(['online' => true]);

    }
}
