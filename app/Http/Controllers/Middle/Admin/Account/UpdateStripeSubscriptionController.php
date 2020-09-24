<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use Stripe\StripeClient;

class UpdateStripeSubscriptionController extends Controller
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
        $store = session('store');

        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        $subscribes = [
            'price_1HTE5ULNXgoErTPagaOviWAl' => '14.99 € / Mois',
            'price_1HAJeVLNXgoErTPaxHB6IYCw' => '159 € / An'
        ];

        $paymentMethods = [];
        $subscriptions = [];

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $subscriptions = $stripe->subscriptions->all([
            'customer' => $store->stripe_customer_id
        ]);

        return view('admin.middle.account.admin_middle_stripe_update_subscription_show', [
            'stores' => $stores,
//            'userFonctions' => $this->userFonctions,
            'subscribes' => $subscribes,
            'medias' => $medias,
            'store' => $store,
            'paymentMethods' => $paymentMethods,
            'subscriptions' => $subscriptions,
        ]);
    }
}
