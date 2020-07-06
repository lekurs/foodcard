<?php


namespace App\Http\Controllers\Admin\Stores\Types;


use App\Http\Controllers\Controller;
use App\Repository\StoreTypeRepository;
use Illuminate\View\View;

class StoreTypeShowController extends Controller
{
    /**
     * @var StoreTypeRepository $storeTypeRepository
     */
    private $storeTypeRepository;

    /**
     * StoreTypeShowController constructor.
     * @param StoreTypeRepository $storeTypeRepository
     */
    public function __construct(StoreTypeRepository $storeTypeRepository)
    {
        $this->storeTypeRepository = $storeTypeRepository;
    }

    public function show(): View
    {
        $types = $this->storeTypeRepository->getAll();

        return view('admin.stores.types.store_type_show', [
            'types' => $types
        ]);
    }
}
