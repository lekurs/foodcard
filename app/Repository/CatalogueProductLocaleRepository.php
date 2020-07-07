<?php


namespace App\Repository;


use App\Entity\CatalogueProductLocale;

class CatalogueProductLocaleRepository
{
    public function store(array $datas): void
    {
        dd($datas);
        $product = new CatalogueProductLocale();
        $product->libelle = $datas[''];
    }
}
