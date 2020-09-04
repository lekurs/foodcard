<?php


namespace App\Http\Controllers\Middle\Admin\Menu;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueProductRepository;

class UpdateAjaxMenuController extends Controller
{
    private CatalogueProductRepository $catalogueProductRepository;

    /**
     * UpdateAjaxMenuController constructor.
     * @param CatalogueProductRepository $catalogueProductRepository
     */
    public function __construct(CatalogueProductRepository $catalogueProductRepository)
    {
        $this->catalogueProductRepository = $catalogueProductRepository;
    }


    public function __invoke()
    {
        $idProduct = request()->idProduct;

        $product = $this->catalogueProductRepository->getOneWithLocales($idProduct);

        $result = [
            "allergy" => $product->allergy,
            "price" => $product->catalogueProductFloats->first()->price,
            "buy_price" => $product->catalogueProductFloats->first()->buying_price,
            "special_price" => $product->catalogueProductFloats->first()->special_price,
            "locales" => []
        ] ;

        foreach($product->locales as $locale) {
            $result['locales'][$locale->locale->label] = $locale;
        }

        return response()->json($result);
    }
}
