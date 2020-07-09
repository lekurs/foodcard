<?php


namespace App\Repository;


use App\Entity\UserRole;
use Illuminate\Database\Eloquent\Collection;

class UserRoleRepository
{
    private UserRole $userRole;

    /**
     * UserRoleRepository constructor.
     * @param UserRole $userRole
     */
    public function __construct(UserRole $userRole)
    {
        $this->userRole = $userRole;
    }

    public function getAll(): Collection
    {
        return UserRole::all();
    }

    public function getOne(int $id): UserRole
    {
        return UserRole::whereId($id)->first();
    }

    public function update(array $datas): void
    {
        $userRole = new UserRole();
        $userRole->role = $datas['role'];
        $userRole->save();
    }

    public function trash(int $id): void
    {
        $userRole = UserRole::whereid($id);
        $userRole->delete();
    }
}
