<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\AdminMiddleController;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\CatalogueCategoryLocaleRepository;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\DeclareDeclare;
use Stripe\Customer;
use Stripe\Invoice;
use Stripe\InvoiceItem;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Subscription;

class BillingPortalController extends AdminMiddleController
{
    use SessionRedirection;

    private UserRepository $userRepository;

    private StoreRepository $storeRepository;

    public function __construct(
        UserRepository $userRepository,
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository, StoreRepository $storeRepository1
    ) {
        parent::__construct($userFonctionRepository, $storeRepository, $userRepository);

        $this->userRepository = $userRepository;
        $this->storeRepository = $storeRepository1;
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

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        if(isset($store->stripe_customer_id)) {
            $customer = $stripe->customers->retrieve($store->stripe_customer_id);

            $paymentMethods = $stripe->paymentMethods->all([
                'customer' => $customer->id,
                'type' => 'card'
            ]);

            $subscriptions = $customer->subscriptions;
        }

        return view('admin.middle.account.admin_middle_billing_portal_show', [
            'stores' => $stores,
            'userFonctions' => $this->userFonctions,
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

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Customer::create([
            'name' => request('name'),
            'email' => request('email'),
            'description' => 'Paiement de l\'application Foodcard',
            'source' => request('stripeToken')
        ]);

        $subscription = Subscription::create([
            'customer' => $customer->id,
            'items' => [
                ["price" => \request('amount')],
            ],
        ]);

        $this->storeRepository->updateStripe(session('store'), $customer->id);
//        $this->userRepository->updateStripe(auth()->user()->id, $customer->id);

        return redirect()->route('adminMiddleAccountShow')->with('success', 'Nous vous remercions pour votre abonnement');
    }
}
