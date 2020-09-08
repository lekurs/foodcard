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
        '/admin-client/store/utilisateur/edit',
        '/admin-client/store/utilisateur/trash',
        '/admin-client/compte/subscribe',
        '/admin-client/ma-carte/subcategory',
        '/admin-client/ma-carte/products',
        '/admin-client/ma-carte/product/online/update',
        '/admin-client/ma-carte/product/update'
    ];
}
