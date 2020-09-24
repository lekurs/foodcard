<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;

class StripeCreateNewCreditCardController extends Controller
{
    use SessionRedirection;

    private UserRepository $userRepository;

    private StoreRepository $storeRepository;

    /**
     * UpdateStripeSubscriptionController constructor.
     * @param UserRepository $userRepository
     * @param StoreRepository $storeRepository
     */
    public function __construct(UserRepository $userRepository, StoreRepository $storeRepository)
    {
        $this->userRepository = $userRepository;
        $this->storeRepository = $storeRepository;
    }

    public function __invoke()
    {
        $this->redirectNoSession();
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;

        return view('admin.middle.account.admin_middle-stripe_create_card', [
            'stores' => $stores,
        ]);
    }
}
