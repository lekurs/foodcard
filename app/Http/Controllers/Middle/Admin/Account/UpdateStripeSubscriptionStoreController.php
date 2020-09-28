<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use App\Services\PSP\PSPServices;
use Stripe\StripeClient;

class UpdateStripeSubscriptionStoreController extends Controller
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

        $subscriptions = $this->phpServices->getAllSubscriptionsByStore($store);

        foreach ($subscriptions as $subscription) {

            $this->phpServices->updateSubscriptionById($subscription, request('amount'));
        }

        return back()->with('success', 'Votre abonnement a bien été modifié');
    }
}
