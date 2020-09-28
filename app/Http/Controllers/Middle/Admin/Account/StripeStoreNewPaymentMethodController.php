<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeStoreNewPaymentMethodController extends Controller
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

        request()->validate([
            "name" => ['required'],
            ]);

        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $customer = $stripe->customers->retrieve(
            session('store')->stripe_customer_id
        );

        $payment = $stripe->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'token' => request('stripeToken'),
            ],
        ]);

        $stripe->paymentMethods->attach(
            $payment->id,
            ['customer' => $customer->id]
        );

        return back()->with('success', 'Votre carte a bien été ajoutée');

    }
}
