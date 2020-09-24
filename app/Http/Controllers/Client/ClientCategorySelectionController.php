<?php


namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use Stripe\StripeClient;

class ClientCategorySelectionController extends Controller
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

    public function __invoke(string $storeSlug, int $categoryId)
    {
        $store = $this->storeRepository->getOneBySlug($storeSlug);
        $user = $this->userRepository->getUserByStore($store->id);
        $categories = $this->catalogueCategoryRepository->getAllMainCategories();
        $subcategories = $this->catalogueCategoryRepository->getAllChildrenById($categoryId);

        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $customer = $stripe->customers->retrieve($user->stripe_id);

        foreach ($customer->subscriptions->data as $subscription) {
            $end = strftime($subscription->current_period_end);
        }

        if ($end >= date('now')) {
            return view('client.api_category_selection', [
                'store' => $store,
                'medias' => $medias,
                'subcategories' => $subcategories,
                'categories' => $categories,
            ]);
        } else {
            return abort(403);
        }
    }
}
