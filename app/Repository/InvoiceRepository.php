<?php


namespace App\Repository;


use App\Entity\Invoice;
use Illuminate\Database\Eloquent\Collection;

class InvoiceRepository
{
    private Invoice $invoice;

    /**
     * InvoiceRepository constructor.
     * @param Invoice $invoice
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function getAllByStore(): Collection
    {
        return $this->invoice::with('store')->get();
    }
}
