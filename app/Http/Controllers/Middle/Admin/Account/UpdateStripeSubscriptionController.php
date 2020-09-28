<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use App\Services\PSP\PSPServices;
use Stripe\StripeClient;

class UpdateStripeSubscriptionController extends Controller
{
    use SessionRedirection;

    private UserRepository $userRepository;

    private StoreRepository $storeRepository;

    private PSPServices $phpServices;

    /**
     * UpdateStripeSubscriptionController constructor.
     * @param UserRepository $userRepository
     * @param StoreRepository $storeRepository
     * @param PSPServices $phpServices
     */
    public function __construct(UserRepository $userRepository, StoreRepository $storeRepository, PSPServices $phpServices)
    {
        $this->userRepository = $userRepository;
        $this->storeRepository = $storeRepository;
        $this->phpServices = $phpServices;
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

        $subscriptions = $this->phpServices->getAllSubscriptionsByStore($store);

        return view('admin.middle.account.admin_middle_stripe_update_subscription_show', [
            'stores' => $stores,
            'subscribes' => $subscribes,
            'medias' => $medias,
            'store' => $store,
            'paymentMethods' => $paymentMethods,
            'subscriptions' => $subscriptions,
        ]);
    }
}
