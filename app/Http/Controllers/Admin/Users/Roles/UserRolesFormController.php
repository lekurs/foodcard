<?php


namespace App\Http\Controllers\Admin\Users\Roles;


use App\Http\Controllers\Controller;
use App\Repository\UserRoleRepository;
use App\Requests\User\Role\RoleRequest;
use Illuminate\Http\JsonResponse;

class UserRolesFormController extends Controller
{
    /**
     * @var UserRoleRepository $userRoleRepository
     */
    private UserRoleRepository $userRoleRepository;

    /**
     * UserRolesFormController constructor.
     * @param UserRoleRepository $userRoleRepository
     */
    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
    }


    public function store()
    {

    }

    /**
     * @param int $id
     * @param RoleRequest $validator
     * @return JsonResponse
     */
    public function update(int $id, RoleRequest $validator): JsonResponse
    {
        $role = $this->userRoleRepository->getOne($id);

        $datas = $validator->all();

        $role->update($datas);

        return new JsonResponse('success');
    }

    public function trash(int $id): JsonResponse
    {
        $this->userRoleRepository->trash($id);

        return new JsonResponse('success');

    }
}
