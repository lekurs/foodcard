<?php


namespace App\Http\Controllers\Client;


use App\Http\Controllers\Controller;
use App\Repository\AllergyRepository;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\CatalogueProductRepository;
use App\Repository\StoreRepository;
use App\Repository\UserRepository;
use Stripe\StripeClient;

class ClientProductShowController extends Controller
{
    private StoreRepository $storeRepository;

    private CatalogueCategoryRepository $catalogueCategoryRepository;

    private CatalogueProductRepository $catalogueProductRepository;

    private UserRepository $userRepository;

    private AllergyRepository $allergyRepository;

    /**
     * StoreHomeController constructor.
     * @param StoreRepository $storeRepository
     * @param CatalogueCategoryRepository $catalogueCategoryRepository
     * @param CatalogueProductRepository $catalogueProductRepository
     * @param UserRepository $userRepository
     * @param AllergyRepository $allergyRepository
     */
    public function __construct(
        StoreRepository $storeRepository,
        CatalogueCategoryRepository $catalogueCategoryRepository,
        CatalogueProductRepository $catalogueProductRepository,
        UserRepository $userRepository,
        AllergyRepository $allergyRepository
    ) {
        $this->storeRepository = $storeRepository;
        $this->catalogueCategoryRepository = $catalogueCategoryRepository;
        $this->catalogueProductRepository = $catalogueProductRepository;
        $this->userRepository = $userRepository;
        $this->allergyRepository = $allergyRepository;
    }

    public function __invoke(string $storeSlug, int $categoryId, int $subCategoryId, int $productId)
    {
        $store = $this->storeRepository->getOneBySlug($storeSlug);
        $user = $this->userRepository->getUserByStore($store->id);
        $categories = $this->catalogueCategoryRepository->getAllMainCategories();
        $subcategory = $this->catalogueCategoryRepository->getOneWithLocalesById(request('subcategoryId'));
        $product = $this->catalogueProductRepository->getOneWithLocalesAndMediasById($productId);

        $medias = [];

        foreach ($store->storeMedias as $mediasTab) {
            $medias[$mediasTab->type] = $mediasTab;
        }

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $customer = $stripe->customers->retrieve($user->stripe_id);

        foreach ($customer->subscriptions->data as $subscription) {
            $end = strftime($subscription->current_period_end);
        }

        $allergyByProduct = explode('|', $product->allergy);
        $allergies = $this->allergyRepository->getAll();

        if ($end >= date('now')) {
            return view('client.api_product_show', [
                'store' => $store,
                'categories' => $categories,
                'subcategory' => $subcategory,
                'product' => $product,
                'allergyByProduct' => $allergyByProduct,
                'allergies' => $allergies
            ]);
        } else {
            return abort(403);
        }
    }
}
