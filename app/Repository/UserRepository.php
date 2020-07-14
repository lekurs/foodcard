<?php


namespace App\Repository;

use App\Entity\Store;
use App\Entity\User;
use Illuminate\Database\Eloquent\Collection;
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


    public function getStoresByUser(User $user): ?User
    {
        return $this->user->newQuery()->with('stores')->whereId($user->id)->first();
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

        $store = new Store();
        $store->name = $datas['store'];
        $store->slug = Str::slug($store->name);
        $store->store_type_id = $datas['store-type'];
        $store->active = true;
        $store->save();

        $user->stores()->sync([$store->id]);

        return $user;
    }
}
