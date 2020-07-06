<?php


namespace App\Http\Controllers\Admin\Category;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueCategoryLocaleRepository;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\LocaleRepository;
use App\Requests\Catalogue\Category\CatalogueCategoryCreation;
use Illuminate\View\View;

class CatalogueCategoryFormController extends Controller
{
    /**
     * @var CatalogueCategoryRepository
     */
    private $catalogueCategoryRepository;

    /**
     * @var LocaleRepository $localeRepository
     */
    private $localeRepository;

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

    public function create(): View
    {
        $locales = $this->localeRepository->getAll();
        $categoryLocales = $this->catalogueCategoryLocaleRepository->getAll();

        return \view('admin.category.catalogue_category_creation', [
            'locales' => $locales,
            'categoryLocales' => $categoryLocales
        ]);
    }

    private function searchItemsByKey($array, $key)
    {
        $results = array();

        if (is_array($array))
        {
            if (isset($array[$key])){
                $children = [];
                foreach($array[$key] as $k => $v){
                    $children[] = $v["id"];
                }
                $results[] = ["parent" => $array["id"], "children" =>  $children];
            }


            foreach ($array as $sub_array)
                $results = array_merge($results, $this->searchItemsByKey($sub_array, $key));
        }

        return $results;
    }

    public function navUpdate()
    {
        $json = json_decode(request()->request->get('navigation'), true);

        dd($this->searchItemsByKey($json, 'children'));
    }

    public function store(CatalogueCategoryCreation $validator)
    {
//        dd($validates->all());
        $validates = $validator->all();

        $this->catalogueCategoryRepository->store($validates);

        return back()->with('success', 'Catégorie ajoutée');
    }
}
