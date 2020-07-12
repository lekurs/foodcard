<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Repository\UserRepository;
use Illuminate\View\View;

class AccountShowController extends Controller
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    /**
     * AccountShowController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function show(): View
    {
        return view('admin.middle.account.admin_middle_account_show', [

        ]);
    }
}
