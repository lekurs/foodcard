<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use App\Services\PSP\PSPServices;
use Stripe\StripeClient;

class StripeAddSubcriptionController extends Controller
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
    public function __construct(
        UserRepository $userRepository,
        StoreRepository $storeRepository,
        PSPServices $phpServices
    ) {
        $this->userRepository = $userRepository;
        $this->storeRepository = $storeRepository;
        $this->phpServices = $phpServices;
    }

    public function __invoke()
    {
        $this->redirectNoSession();

        $customer = $this->phpServices->getCustomerByStore(
            session('store')->stripe_customer_id,
        );

        $newSubsription = $this->phpServices->createSubscription($customer, request('amount'));

//        $newSubsription = $stripe->subscriptions->create([
//            'customer' => $customer->id,
//            'items' => [
//                ['price' => request('amount')],
//            ],
//        ]);

        if ($newSubsription->status === "active") {
            return back()->with('success', 'Votre abonnement à bien été activé');
        } else {
            return back()->with('error', 'Une erreur est survenue');
        }
    }
}
