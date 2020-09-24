<?php


namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use Stripe\StripeClient;

class ClientProductsSelectionController extends Controller
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

    public function __invoke(string $storeSlug, int $subcategoryId)
    {
        $store = $this->storeRepository->getOneBySlug($storeSlug);
        $user = $this->userRepository->getUserByStore($store->id);
        $categories = $this->catalogueCategoryRepository->getAllMainCategories();
        $category = $this->catalogueCategoryRepository->getOneByIdWithAllProductsOnlineByStore(request('subcategoryId'), $store->id);
        $subcategory = $this->catalogueCategoryRepository->getOneWithLocalesById(request('subcategoryId'));

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
            return view('client.api_product_selection', [
                'store' => $store,
                'medias' => $medias,
                'categories' => $categories,
                'category' => $category,
                'subcategory' => $subcategory
            ]);
        } else {
            return abort(403);
        }
    }
}
