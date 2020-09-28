<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use App\Services\PSP\PSPServices;
use Stripe\StripeClient;

class StripeDeleteSubscriptionController extends Controller
{
    use SessionRedirection;

    private UserRepository $userRepository;

    private StoreRepository $storeRepository;

    private PSPServices $pspServices;

    /**
     * UpdateStripeSubscriptionController constructor.
     * @param UserRepository $userRepository
     * @param StoreRepository $storeRepository
     * @param PSPServices $pspServices
     */
    public function __construct(UserRepository $userRepository, StoreRepository $storeRepository, PSPServices $pspServices)
    {
        $this->userRepository = $userRepository;
        $this->storeRepository = $storeRepository;
        $this->pspServices = $pspServices;
    }

    public function __invoke()
    {
        $this->redirectNoSession();

        $subscription = $this->pspServices->getAllSubscriptionsByStore(session('store'));

        $canceled = $this->pspServices->deleteSubscription($subscription);

        if ($canceled->status === 'canceled') {
            return back()->with('success', 'Votre abonnement à bien été annulé');

        } else {
            return back()->with('error', 'Une erreur est apparue');
        }
    }
}
