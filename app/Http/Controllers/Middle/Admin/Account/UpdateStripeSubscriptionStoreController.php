<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use Stripe\StripeClient;

class UpdateStripeSubscriptionStoreController extends Controller
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

        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;
        $store = session('store');

        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $subscriptions = $stripe->subscriptions->all([
            'customer' => $store->stripe_customer_id
        ]);

        foreach ($subscriptions as $subscription) {
            $stripe->subscriptions->update(
                $subscription->id,
                [
                    'cancel_at_period_end' => false,
                    'proration_behavior' => 'create_prorations',
                    'items' => [
                        [
                            'id' => $subscription->items->data[0]->id,
                            'price' => request('amount'),
                        ],
                    ],
                ],
            );
        }

        return back()->with('success', 'Votre abonnement a bien été modifié');
    }
}
