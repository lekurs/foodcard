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
        $categoryLocales = $this->catalogueCategoryLocaleRepository->getAllWithCatalogueCategories();

//        dd($categoryLocales);

        return \view('admin.category.catalogue_category_creation', [
            'locales' => $locales,
            'categoryLocales' => $categoryLocales
        ]);
    }

    private function getChildren($array, $noeud, $parent)
    {
        static $output = array();
            foreach($array as $key => $sub){
                $output[] = [
                    "id" => $sub["id"],
                    "parent" => $parent
                ];
                if(isset($sub[$noeud])){
                    //il y a un enfant on recommence
                    $this->getChildren($sub[$noeud], $noeud, $sub["id"]);
                }
            }
        return $output;
    }

    public function catalogueCategoriesPositionUpdate()
    {
        $json = json_decode(request()->request->get('navigation'), true);

        $datas = $this->getChildren($json, 'children', null);

        $this->catalogueCategoryRepository->update($datas);

        //Ordre = clé => parent => 'parent', entity_id => 'id'
    }

    public function store(CatalogueCategoryCreation $validator)
    {
//        dd($validates->all());
        $validates = $validator->all();

        $this->catalogueCategoryRepository->store($validates);

        return back()->with('success', 'Catégorie ajoutée');
    }
}
