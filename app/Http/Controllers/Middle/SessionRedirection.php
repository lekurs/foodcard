<?php


namespace App\Http\Controllers\Middle;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

trait SessionRedirection
{
    public function redirectNoSession()
    {
        if (!session('store')) {
            return redirect()->route('adminMiddleShow');
        }
    }
}
