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

    public function getOneById(int $id): User
    {
        return $this->user->newQuery()->whereId($id)->first();
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

    public function createUserInStore(array $datas): void
    {
        if (is_null($datas['userid'])) {
            $user = new User();
            $user->name = $datas['username'];
            $user->lastname = $datas['lastname'];
            $user->user_fonction_id = $datas['user-fonction'];
            $user->email = $datas['email'];
            $user->phone = $datas['user-phone'];
            $user->password = Hash::make($datas['password']);
            $user->user_role_id = 3;
            $user->slug = Str::slug($datas['username'] . '-' .$datas['lastname']);
            $user->save();

            $user->stores()->sync([request()->session()->get('store')->id]);
        } else {
            $user = $this->user->newQuery()->whereId($datas['userid'])->first();
            $user->name = $datas['username'];
            $user->lastname = $datas['lastname'];
            $user->user_fonction_id = $datas['user-fonction'];
            $user->email = $datas['email'];
            $user->phone = $datas['user-phone'];
            if (!is_null($datas['password'])) {
                $user->password = Hash::make($datas['password']);
            }
            $user->user_role_id = 3;
            $user->slug = Str::slug($datas['username'] . '-' .$datas['lastname']);
            $user->save();

            $user->stores()->sync([request()->session()->get('store')->id]);
        }
    }

    public function updateStripe($userId, string $stipeCustomer): void
    {
        $user = $this->getOneById($userId);
        $user->stripe_id = $stipeCustomer;
        $user->save();
    }

    public function trashUser(int $id)
    {
        $user = $this->getOneById($id);
        $user->delete();
    }
}
