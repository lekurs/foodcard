<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Entity\User;
use App\Repository\StoreTypeRepository;
use App\Repository\UserRepository;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    private UserRepository $userRepository;

    private StoreTypeRepository $storeTypeRepository;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepository
     * @param StoreTypeRepository $storeTypeRepository
     */
    public function __construct(UserRepository $userRepository, StoreTypeRepository $storeTypeRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
        $this->storeTypeRepository = $storeTypeRepository;
    }

    public function showRegistrationForm()
    {
        $storeTypes = $this->storeTypeRepository->getAll();

        return view('auth.mout-register', [
            'storeTypes' => $storeTypes
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'store' => ['required', 'max:255'],
            'store-type' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Entity\User
     */
    protected function create(array $data)
    {
//        dd($data);
        return $this->userRepository->createUser($data);
    }
}
