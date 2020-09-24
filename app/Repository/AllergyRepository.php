<?php


namespace App\Repository;


use App\Entity\Allergy;
use Illuminate\Database\Eloquent\Collection;

class AllergyRepository
{
    public function getAll(): Collection
    {
        return Allergy::all();
    }

    public function getAllWithProducts(): Collection
    {
        return Allergy::with('products')->get();
    }

    public function getAllByProduct($productId): Collection
    {
        return Allergy::with(['products' => function($q) use ($productId) {
            $q->whereCatalogueProductId($productId);
        }])->get();
    }
}
