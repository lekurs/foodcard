<?php


namespace App\Repository;


use App\Entity\Locale;
use Illuminate\Database\Eloquent\Collection;

class LocaleRepository
{
    public function getAll(): Collection
    {
        return Locale::all();
    }
}
