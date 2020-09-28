<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use App\Services\PSP\PSPServices;

class BillingPortalController extends Controller
{
    use SessionRedirection;

    private UserRepository $userRepository;

    private StoreRepository $storeRepository;

    private UserFonctionRepository $userFonctionRepository;

    private PSPServices $pspServices;

    public function __construct(
        UserRepository $userRepository,
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository,
        PSPServices $pspServices
    ) {

        $this->userRepository = $userRepository;
        $this->userFonctionRepository = $userFonctionRepository;
        $this->storeRepository = $storeRepository;
        $this->pspServices = $pspServices;
    }

    public function show() {
        $this->redirectNoSession();

        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
        $store = $this->storeRepository->getOneBySlug(session('store')->slug);

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
        $customer = [];

        if(isset($store->stripe_customer_id)) {
            $customer = $this->pspServices->getCustomerByStore($store);

            $paymentMethods = $this->pspServices->getAllPaymentMethodsByCustomer($customer);

            $subscriptions = $customer->subscriptions;
        }

        return view('admin.middle.account.admin_middle_billing_portal_show', [
            'stores' => $stores,
            'subscribes' => $subscribes,
            'medias' => $medias,
            'store' => $store,
            'paymentMethods' => $paymentMethods,
            'subscriptions' => $subscriptions,
            'customer' => $customer
        ]);
    }

    public function subscribe() {

        $user = request()->user();

        $this->redirectNoSession();

        request()->validate([
            "amount" => ['required'],
            "email" => ['required', 'email'],
            "name" => ['required'],
            "address" => ['required'],
            "city" => ['required'],
            "zip" => ['required'],
            "stripeToken" => ['required']
        ]);

        $datasCustomer = [
            'name' => request('name'),
            'email' => request('email'),
            'description' => 'Paiement de l\'application Foodcard',
            'source' => request('stripeToken')
        ];

        $customer = $this->pspServices->createCustomer($datasCustomer);

        $this->pspServices->createSubscription($customer, request('amount'));

        $this->storeRepository->updateStripe(session('store'), $customer->id);

        return redirect()->route('adminMiddleAccountShow')->with('success', 'Nous vous remercions pour votre abonnement');
    }
}
