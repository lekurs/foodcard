<?php


namespace App\Http\Controllers\Admin\Product;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueProductRepository;
use Illuminate\Http\RedirectResponse;

class CatalogueProductActionsController extends Controller
{
    /**
     * @var CatalogueProductRepository $catalogueProductRepository
     */
    private $catalogueProductRepository;

    /**
     * CatalogueProductActionsController constructor.
     * @param CatalogueProductRepository $catalogueProductRepository
     */
    public function __construct(CatalogueProductRepository $catalogueProductRepository)
    {
        $this->catalogueProductRepository = $catalogueProductRepository;
    }


    public function trash(int $id): RedirectResponse
    {
        $product = $this->catalogueProductRepository->trash($id);

        return redirect()->back()->with('success', 'Produit supprimé');
    }
}
