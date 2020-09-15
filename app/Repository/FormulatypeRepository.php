<?php


namespace App\Repository;


use App\Entity\FormulaType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class FormulatypeRepository
{
    public function getAll(): Collection
    {
        return FormulaType::all();
    }

    public function store(array $datas): void
    {
        $formulaType = new FormulaType();
        $formulaType->label = $datas['label'];
        $formulaType->icon = $datas['icon'];
        $formulaType->slug = Str::slug($datas['label']);

        $formulaType->save();
    }
}
