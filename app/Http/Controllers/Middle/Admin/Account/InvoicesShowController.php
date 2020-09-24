<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Middle\SessionRedirection;
use App\Repository\InvoiceRepository;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use Illuminate\View\View;
use Stripe\StripeClient;

class InvoicesShowController extends Controller
{
    use SessionRedirection;

    private InvoiceRepository $invoiceRepository;

    private UserRepository $userRepository;

    private StoreRepository $storeRepository;

    private UserFonctionRepository $userFonctionRepository;

    /**
     * InvoicesShowController constructor.
     * @param InvoiceRepository $invoiceRepository
     * @param UserRepository $userRepository
     * @param StoreRepository $storeRepository
     * @param UserFonctionRepository $userFonctionRepository
     */
    public function __construct(
        InvoiceRepository $invoiceRepository,
        UserRepository $userRepository,
        StoreRepository $storeRepository,
        UserFonctionRepository $userFonctionRepository
    ) {
        $this->invoiceRepository = $invoiceRepository;
        $this->userRepository = $userRepository;
        $this->storeRepository = $storeRepository;
        $this->userFonctionRepository = $userFonctionRepository;
    }


    public function __invoke(): View
    {
        $this->redirectNoSession();

        $userFonctions = $this->userFonctionRepository->getAll();
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;

        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $customer = $stripe->customers->retrieve(session('store')->stripe_customer_id);

        $invoices = $stripe->invoices->all([
            'customer' => $customer->id
        ]);

        return view('admin.middle.account.admin_middle_invoices_show', [
            'invoices' => $invoices,
            'userFonctions' => $userFonctions,
            'stores' => $stores
        ]);
    }
}
