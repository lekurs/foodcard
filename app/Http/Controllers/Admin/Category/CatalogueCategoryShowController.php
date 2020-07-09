<?php


namespace App\Http\Controllers\Admin\Category;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueCategoryRepository;
use Illuminate\View\View;

class CatalogueCategoryShowController extends Controller
{
    /**
     * @var CatalogueCategoryRepository
     */
    private $catalogueCategoryRepository;

    /**
     * CatalogueCategoryShowController constructor.
     * @param CatalogueCategoryRepository $catalogueCategoryRepository
     */
    public function __construct(CatalogueCategoryRepository $catalogueCategoryRepository)
    {
        $this->catalogueCategoryRepository = $catalogueCategoryRepository;
    }

    public function show(): View
    {
        return \view();
    }
}
