<?php


namespace App\Http\Controllers\Admin\Users;


use App\Http\Controllers\Controller;
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
        return view('admin.users.user_show');
    }
}
