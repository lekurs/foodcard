<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/admin/produits/update/view',
        '/foodcard/admin/store/utilisateur/edit',
        '/foodcard/admin/store/utilisateur/trash',
        '/foodcard/admin/compte/subscribe',
        '/foodcard/admin/ma-carte/subcategory'
    ];
}
