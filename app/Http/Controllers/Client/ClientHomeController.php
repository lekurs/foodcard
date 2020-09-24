<?php


namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use Stripe\StripeClient;

class ClientHomeController extends Controller
{
    private StoreRepository $storeRepository;

    private CatalogueCategoryRepository $catalogueCategoryRepository;

    private UserRepository $userRepository;

    /**
     * StoreHomeController constructor.
     * @param StoreRepository $storeRepository
     * @param CatalogueCategoryRepository $catalogueCategoryRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        StoreRepository $storeRepository,
        CatalogueCategoryRepository $catalogueCategoryRepository,
        UserRepository $userRepository
    ) {
        $this->storeRepository = $storeRepository;
        $this->catalogueCategoryRepository = $catalogueCategoryRepository;
        $this->userRepository = $userRepository;
    }


    public function __invoke(string $storeSlug)
    {
        $store = $this->storeRepository->getOneBySlug($storeSlug);
        $categories = $this->catalogueCategoryRepository->getAllMainCategories();
        $user = $this->userRepository->getUserByStore($store->id);

        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $customer = $stripe->customers->retrieve($store->stripe_customer_id);

        if (!isset($customer->subscriptions)) {
            return abort(403);
        }

        foreach ($customer->subscriptions->data as $subscription) {
            $end = strftime($subscription->current_period_end);
        }

        if ($end >= date('now')) {
            return view('client.api_index', [
                'store' => $store,
                'medias' => $medias,
                'categories' => $categories
            ]);
        } else {
            return abort(403);
        }
    }
}
