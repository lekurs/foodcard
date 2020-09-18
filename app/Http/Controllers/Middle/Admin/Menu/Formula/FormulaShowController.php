<?php


namespace App\Http\Controllers\Middle\Admin\Menu\Formula;


use App\Http\Controllers\Controller;
use App\Repository\FormulatypeRepository;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use Illuminate\View\View;

class FormulaShowController extends Controller
{
    private FormulatypeRepository  $formulatypeRepository;

    private UserRepository $userRepository;

    private UserFonctionRepository $userFonctionRepository;

    private StoreRepository $storeRepository;

    /**
     * FormulaShowController constructor.
     * @param FormulatypeRepository $formulatypeRepository
     * @param UserRepository $userRepository
     * @param UserFonctionRepository $userFonctionRepository
     * @param StoreRepository $storeRepository
     */
    public function __construct(
        FormulatypeRepository $formulatypeRepository,
        UserRepository $userRepository,
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository
    )
    {
        $this->formulatypeRepository = $formulatypeRepository;
        $this->userRepository = $userRepository;
        $this->userFonctionRepository = $userFonctionRepository;
        $this->storeRepository = $storeRepository;
    }

    public function __invoke(): View
    {
        $userFonctions = $this->userFonctionRepository->getAll();
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
//        $store = $this->storeRepository->getOneBySlug(session('store')->slug);
//        $medias = [];
//
//        foreach ($store->storeMedias as $mediasTab) {
//            $medias[$mediasTab->type] = $mediasTab;
//        }

        $formulatypes = $this->formulatypeRepository->getAll();

//        dd($formulatypes);

        return \view('admin.middle.menu.formula.admin_middle_formula_show', [
            'userFonctions' => $userFonctions,
            'stores' => $stores,
//            'medias' => $medias,
//            'store' => $store
        ]);
    }
}
