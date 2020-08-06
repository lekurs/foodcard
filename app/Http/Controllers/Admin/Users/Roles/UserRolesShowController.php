<?php


namespace App\Http\Controllers\Admin\Users\Roles;


use App\Http\Controllers\Controller;
use App\Repository\UserRoleRepository;
use Illuminate\View\View;

class UserRolesShowController extends Controller
{
    private UserRoleRepository $userRoleRepository;

    /**
     * UserRolesShowController constructor.
     * @param UserRoleRepository $userRoleRepository
     */
    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
    }

    public function show(): View
    {
        $roles = $this->userRoleRepository->getAll();

        return \view('admin.users.roles.user_roles_show', [
            'roles' => $roles
        ]);
    }
}
