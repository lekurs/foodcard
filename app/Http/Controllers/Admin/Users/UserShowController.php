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
     * UserShowController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function show(): View
    {
        $storeTypes = ['1', '2'];

        return view('admin.users.user_show', [
//            'storeTypes' => $storeTypes
        ]);
    }
}
