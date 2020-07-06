<?php


namespace App\Http\Controllers\Admin\Stores\Types;


use App\Http\Controllers\Controller;
use App\Repository\StoreTypeRepository;
use App\Requests\Store\StoreCreation;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StoreTypeFormController extends Controller
{
    /**
     * @var StoreTypeRepository $storeTypeRepository
     */
    private StoreTypeRepository $storeTypeRepository;

    /**
     * StoreTypeFormController constructor.
     * @param StoreTypeRepository $storeTypeRepository
     */
    public function __construct(StoreTypeRepository $storeTypeRepository)
    {
        $this->storeTypeRepository = $storeTypeRepository;
    }

    /**
     * @return View
     */
    public function show(): View
    {
        return \view('admin.stores.types.store_type_show');
    }

    /**
     * @param StoreCreation $validator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(StoreCreation $validator): RedirectResponse
    {
        $validates = $validator->all();

        $this->storeTypeRepository->store($validates);

        return back()->with('success', 'Type de commerce ajouté');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function trash(int $id): RedirectResponse
    {
        $this->storeTypeRepository->trash($id);

        return back()->with('success', 'Type de commerce supprimé');
    }
}
