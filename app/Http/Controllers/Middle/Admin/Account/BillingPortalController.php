<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\AdminMiddleController;
use App\Repository\CatalogueCategoryLocaleRepository;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class BillingPortalController extends AdminMiddleController
{
    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    private StoreRepository $storeRepository;

    public function __construct(
        UserRepository $userRepository,
        UserFonctionRepository $userFonctionRepository,
        StoreRepository $storeRepository, StoreRepository $storeRepository1
    ) {
        parent::__construct($userFonctionRepository, $storeRepository);

        $this->userRepository = $userRepository;
        $this->storeRepository = $storeRepository1;
    }

    public function show() {
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;

        return view('admin.middle.account.admin_middle_billing_portal_show', [
            'stores' => $stores,
            'userFonctions' => $this->userFonctions,
            'intent' => request()->user()->createSetupIntent([
//                'amount' => 14.99,
//                'currency' => 'eur',

            ])
        ]);
    }

    public function store() {

        Stripe::setApiKey(env('STRIPE_SECRET'));

        header('Content-Type: application/json');

        # retrieve json from POST body
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str);

        $intent = null;
        try {
            if (isset($json_obj->payment_method_id)) {
                # Create the PaymentIntent
                $intent = PaymentIntent::create([
                    'payment_method' => $json_obj->payment_method_id,
                    'confirmation_method' => 'manual',
                    'confirm' => true,
                    'amount'   => 14.99,
                    'currency' => 'eur',
                    'description' => "Mon paiement"
                ]);
            }
            if (isset($json_obj->payment_intent_id)) {
                $intent = PaymentIntent::retrieve(
                    $json_obj->payment_intent_id
                );
                $intent->confirm();
            }
            if ($intent->status == 'requires_action' &&
                $intent->next_action->type == 'use_stripe_sdk') {
                # Tell the client to handle the action
                echo json_encode([
                    'requires_action' => true,
                    'payment_intent_client_secret' => $intent->client_secret
                ]);
            } else if ($intent->status == 'succeeded') {
                // Paiement Stripe accepté
                request()->user()->newSubscription('default', 'amount');
                request()->user()->createAsStripeCustomer();

                echo json_encode([
                    "success" => true
                ]);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Invalid PaymentIntent status']);
            }
        } catch (\Exception $e) {
            # Display error on client
            echo json_encode([
                'error' => $e->getMessage()
            ]);
        }
    }
}
