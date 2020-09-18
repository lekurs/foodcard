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
use PhpParser\Node\Stmt\DeclareDeclare;
use Stripe\Customer;
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
            'price_1HAGA5LNXgoErTPaONjZ2QgL' => 'Mois'
        ];

        return view('admin.middle.account.admin_middle_billing_portal_show', [
            'stores' => $stores,
            'userFonctions' => $this->userFonctions,
            'intent' => request()->user()->createSetupIntent([
//                'amount' => 14.99,
//                'currency' => 'eur',

            ]),
            'subscribes' => $subscribes,
            'medias' => $medias,
            'store' => $store
        ]);
    }

    public function subscribe(Request $request) {
        $user = request()->user();

        dd(request()->all());

        $paymentMethod = $request->payment_method;
        $planId = $request->plan;


        Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Customer::create([
            'source' => $request->stripeToken
        ]);

        $user->newSubscription('default', $planId)->create($paymentMethod);


        $subscription = Subscription::create([
            'customer' => $customer->id,
            'items' => [
                ['price' => 'price_1HAJeVLNXgoErTPaxHB6IYCw'],
            ],
        ]);

        return response(['status' => 'success']);
    }
}
