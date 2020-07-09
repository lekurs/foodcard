<?php


namespace App\Http\Controllers\Admin\Navigation;


use App\Http\Controllers\Controller;
use App\Http\Entity\Navigation;
use Illuminate\View\View;

class NavigationCreationController extends Controller
{
    public function show(): View
    {
        $navigations = Navigation::all();

        return view('bo.admin.navigation-manager.navigation-manager', [
            'navigations' => $navigations,
        ]);
    }
}
