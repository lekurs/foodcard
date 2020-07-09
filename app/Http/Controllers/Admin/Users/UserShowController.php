<?php


namespace App\Http\Controllers\Admin\Users;


use App\Http\Controllers\Controller;
use App\Repository\StoreTypeRepository;
use App\Repository\UserRepository;
use Illuminate\View\View;

class UserShowController extends Controller
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    /**
     * @var StoreTypeRepository
     */
    private StoreTypeRepository $storeTypeRepository;

    /**
     * UserShowController constructor.
     * @param UserRepository $userRepository
     * @param StoreTypeRepository $storeTypeRepository
     */
    public function __construct(UserRepository $userRepository, StoreTypeRepository $storeTypeRepository)
    {
        $this->userRepository = $userRepository;
        $this->storeTypeRepository = $storeTypeRepository;
    }

    public function show(): View
    {
        $storeTypes = $this->storeTypeRepository->getAll();

        return view('admin.users.user_show', [
            'storeTypes' => $storeTypes
        ]);
    }
}
