<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use App\Services\PSP\PSPServices;
use Stripe\StripeClient;

class StripeDefineDefaultPaymentMethodController extends Controller
{
    use SessionRedirection;

    private UserRepository $userRepository;

    private StoreRepository $storeRepository;

    private PSPServices $pspsServices;

    /**
     * UpdateStripeSubscriptionController constructor.
     * @param UserRepository $userRepository
     * @param StoreRepository $storeRepository
     * @param PSPServices $pspsServices
     */
    public function __construct(
        UserRepository $userRepository,
        StoreRepository $storeRepository,
        PSPServices $pspsServices
    ) {
        $this->userRepository = $userRepository;
        $this->storeRepository = $storeRepository;
        $this->pspsServices = $pspsServices;
    }

    public function __invoke(string $paymentMethodId)
    {
        $this->redirectNoSession();

        $defaultPaymentMethod = $this->pspsServices->getPaymentMethod($paymentMethodId);

        $this->pspsServices->updateCustomerByStore(session('store'), $defaultPaymentMethod);

        return back()->with('success', 'Votre mode de paiment a été mis à jour');
    }
}
