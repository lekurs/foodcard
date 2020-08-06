<?php


namespace App\Http\Controllers\Admin\Navigation;


use App\Http\Controllers\Controller;
use App\Repository\NavigationRepository;
use Illuminate\Http\Request;

class NavigationSaveController extends Controller
{
    public function save(Request $request, NavigationRepository $repository)
    {
        $datas = json_decode($request->request->get('navigation'));

        self::searchChild($datas, $datas['id']);
        die;


        $parents = [];

        foreach ($datas as $key => $nav) {
            //on enregistre les parents en base
//            $repository->update($nav->id);
            echo $nav->libelle;

            //On enregistre les enfants
            $parent = $nav->id;
            if (isset($nav->children)) {

                foreach ($nav->children as $child) {

                }

            }
            //
            $parents[] = $nav->id;


        }
        dd('end');

        return response()->json(['success']);
    }

    protected static function searchChild($array, $key) {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key])){
                $children = [];
                foreach($array[$key] as $k => $v) {
                    $children[] = $v["id"];
                }
                $results[] = [  "parent" => $array["id"], "children" =>  $children];
            } else {
                $results[] = [  "parent" => $array["id"], "children" =>  null];
            }


            foreach ($array as $sub_array) {
                $results = array_merge($results, self::searchChild($sub_array, $key));
            }
        }

        return  $results;
    }
}
