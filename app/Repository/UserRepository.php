<?php


namespace App\Repository;

use App\Entity\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    /**
     * @var User $user
     */
    private User $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createUser(array $datas)
    {
        $user = new User();
        $user->name = $datas['name'];
        $user->lastname = $datas['lastname'];
        $user->email = $datas['email'];
        $user->password = Hash::make($datas['password']);
        $user->user_role_id = 1;
        $user->slug = Str::slug($datas['name'] . '-' .$datas['lastname']);

        $user->save();
        return $user;
    }

    public function getOneWithStore()
    {
        return User::with('stores')->get();
    }
}
