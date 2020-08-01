<?php


namespace App\Http\Controllers\Admin\Category;


use App\Http\Controllers\Controller;
use App\Repository\CatalogueCategoryLocaleRepository;
use App\Repository\CatalogueCategoryRepository;
use App\Repository\LocaleRepository;
use App\Requests\Catalogue\Category\CatalogueCategoryCreation;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CatalogueCategoryFormController extends Controller
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

    public function catalogueCategoriesPositionUpdate()
    {
        $json = json_decode(request()->request->get('navigation'), true);

        $datas = $this->getChildren($json, 'children', null);

        $this->catalogueCategoryRepository->update($datas);

        return redirect()->back()->with('success', 'Catégories mises à jour');
    }

    public function store(CatalogueCategoryCreation $validator)
    {
        $validates = $validator->all();

        $file = request()->file('img-category');

        $mimeTypes = ['image/png', 'image/jpeg', 'image/gif', 'image/svg+xml'];

        if ($file->getError() !== 0) {

            return back()->with('error', request()->file()->getErrorMessage());
        }

        if (!in_array($file->getMimeType(), $mimeTypes)) {

            return back()->with('error', 'Pas le bon format de fichier');
        }

        $file->storeAs('/public/category/' . Str::slug(request()->request->get('category')[1]), request()->file('img-category')->getClientOriginalName());

        $this->catalogueCategoryRepository->store($validates);

        return back()->with('success', 'Catégorie ajoutée');
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
}
