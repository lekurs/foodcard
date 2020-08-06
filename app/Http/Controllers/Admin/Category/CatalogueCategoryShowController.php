<?php


namespace App\Http\Controllers\Admin\Category;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueCategoryLocaleRepository;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\LocaleRepository;
use Illuminate\View\View;

class CatalogueCategoryShowController extends Controller
{
    /**
     * @var CatalogueCategoryRepository
     */
    private CatalogueCategoryRepository $catalogueCategoryRepository;

    /**
     * @var LocaleRepository $localeRepository
     */
    private LocaleRepository $localeRepository;

    /**
     * @var CatalogueCategoryLocaleRepository $categoryLocaleRepository
     */
    private $categoryLocaleRepository;
    /**
     * @var CatalogueCategoryLocaleRepository
     */
    private CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository;

    /**
     * CatalogueCategoryFormController constructor.
     *
     * @param CatalogueCategoryRepository $catalogueCategoryRepository
     * @param LocaleRepository $localeRepository
     * @param CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository
     */
    public function __construct(
        CatalogueCategoryRepository $catalogueCategoryRepository,
        LocaleRepository $localeRepository,
        CatalogueCategoryLocaleRepository $catalogueCategoryLocaleRepository
    )
    {
        $this->catalogueCategoryRepository = $catalogueCategoryRepository;
        $this->localeRepository = $localeRepository;
        $this->catalogueCategoryLocaleRepository = $catalogueCategoryLocaleRepository;
    }

    public function show(): View
    {
        $locales = $this->localeRepository->getAll();
        $categoryLocales = $this->catalogueCategoryLocaleRepository->getAllWithCatalogueCategories();
        $categories = $this->catalogueCategoryRepository->getCategoriesWithChildren();
        $libelles = $this->catalogueCategoryRepository->getCategoriesLabel();

        $menu = $this->displayMenu();

        return \view('admin.category.catalogue_category_creation', [
            'locales' => $locales,
            'categoryLocales' => $categoryLocales,
            'menu' => $menu
        ]);
    }

    private function displayMenu(){
        $libelles = $this->catalogueCategoryRepository->getCategoriesLabel();
        $lignes = $this->catalogueCategoryRepository->getCategoriesWithChildren();
        return $this->recursiveLine($lignes, $libelles, $lignes);
    }

    private function recursiveLine($arr, $lib, $origin){
        static $continue = [];
        $lignes = "";
        foreach($arr as $line){
            if(in_array($line->id, $continue)){
                continue;
            }
            $lignes .= "<li class=\"dd-item\" data-id=\"".$line->id."\">";
            $lignes .= "   <div class=\"dd-handle\">".$lib[$line->id]."</div>";
            if(!is_null($line->children)){
                $lignes .="<ol class=\"dd-list\">";
                $new_arr = [];
                $new = explode(",", $line->children);
                foreach($new as $ind){
                    $new_arr[$ind] = $origin[$ind];
                }
                $lignes .= $this->recursiveLine($new_arr, $lib,$origin);
                foreach($new as $ind){
                    array_push($continue, $ind);
                }
                $lignes .= "</ol>";
            }
            $lignes .= " </li>";
        }
        return $lignes;
    }
}
