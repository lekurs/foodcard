<?php


namespace App\Http\Controllers\Middle;


use App\Http\Controllers\Controller;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;

class AdminMiddleController extends Controller
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    /**
     * @var UserFonctionRepository $userFonctionRepository
     */
    private UserFonctionRepository $userFonctionRepository;

    /**
     * @var StoreRepository $storeRepository
     */
    private StoreRepository $storeRepository;

    protected $userFonctions;

    /**
     * AdminMiddleController constructor.
     * @param UserFonctionRepository $userFonctionRepository
     * @param StoreRepository $storeRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository,
        UserRepository $userRepository
    ) {
        $this->userFonctionRepository = $userFonctionRepository;
        $this->storeRepository = $storeRepository;
        $this->userRepository = $userRepository;
        $this->userFonctions = $this->userFonctionRepository->getAll();

        if (!session('store')) {
            return redirect()->route('adminMiddleShow');
        }
    }
}
