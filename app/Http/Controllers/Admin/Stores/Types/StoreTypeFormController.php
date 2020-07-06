<?php


namespace App\Http\Controllers\Admin\Stores\Types;


use App\Http\Controllers\Controller;
use App\Repository\StoreTypeRepository;
use App\Requests\Store\StoreCreation;
use Illuminate\View\View;

class StoreTypeFormController extends Controller
{
    /**
     * @var StoreTypeRepository $storeTypeRepository
     */
    private $storeTypeRepository;

    /**
     * StoreTypeFormController constructor.
     * @param StoreTypeRepository $storeTypeRepository
     */
    public function __construct(StoreTypeRepository $storeTypeRepository)
    {
        $this->storeTypeRepository = $storeTypeRepository;
    }

    public function show(): View
    {
        return \view('admin.stores.types.store_type_show');
    }

    public function create(StoreCreation $validator)
    {
        $validates = $validator->all();

        $this->storeTypeRepository->store($validates);

        return back()->with('success', 'Type de commerce ajouté');
    }

    public function trash(int $id)
    {
        $this->storeTypeRepository->trash($id);

        return back()->with('success', 'Type de commerce supprimé');
    }
}
