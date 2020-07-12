<?php


namespace App\Http\Controllers\Middle\Admin\Account;


use App\Http\Controllers\Controller;
use App\Repository\InvoiceRepository;
use App\Repository\UserRepository;
use Illuminate\View\View;

class InvoicesShowController extends Controller
{
    private InvoiceRepository $invoiceRepository;

    private UserRepository $userRepository;

    /**
     * InvoicesShowController constructor.
     * @param InvoiceRepository $invoiceRepository
     * @param UserRepository $userRepository
     */
    public function __construct(InvoiceRepository $invoiceRepository, UserRepository $userRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->userRepository = $userRepository;
    }


    public function show(): View
    {
//        $invoices = $this->invoiceRepository->getAllByStore();

        return view('admin.middle.account.admin_middle_invoices_show', [
//            'invoices' => $invoices,
        ]);
    }
}
