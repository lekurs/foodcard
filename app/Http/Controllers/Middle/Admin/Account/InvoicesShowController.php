<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Repository\InvoiceRepository;
use App\Repository\StoreRepository;
use App\Repository\UserFonctionRepository;
use App\Repository\UserRepository;
use Illuminate\View\View;
use Stripe\StripeClient;

class InvoicesShowController extends Controller
{
    /**
     * @var InvoiceRepository $invoiceRepository
     */
    private InvoiceRepository $invoiceRepository;

    private UserRepository $userRepository;

    /**
     * @var StoreRepository $storeRepository
     */
    private StoreRepository $storeRepository;

    /**
     * @var UserFonctionRepository $userFonctionRepository
     */
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


    public function show(): View
    {
//        $invoices = $this->invoiceRepository->getAllByStore();
        $userFonctions = $this->userFonctionRepository->getAll();
        $stores = $this->userRepository->getStoresByUser(request()->user())->stores;

        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $ch = $stripe->charges->capture(
            'ch_1HMv5m2eZvKYlo2CiSPHrNex',
            [],
            ['api_key' => env('STRIPE_SECRET')]
        );

        return view('admin.middle.account.admin_middle_invoices_show', [
//            'invoices' => $invoices,
            'userFonctions' => $userFonctions,
            'stores' => $stores
        ]);
    }
}
