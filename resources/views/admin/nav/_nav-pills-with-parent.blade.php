<div class="mout-tab-pane active" id="main">
    <h5 class="mout-tab-title">Dashboard</h5>
    <ul class="nav nav-pills nav-stacked nav-quirk">
        <li>
            <a href="{{route('admin')}}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-user"></i>
                Utilisateurs
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-user"></i>
                Médiathèque
            </a>
        </li>
    </ul>
    <h5 class="mout-tab-title">Menus</h5>
    <ul class="nav nav-pills nav-stacked nav-quirk">
        <li class="nav-parent">
            <div class="nav-parent-container">
                <i class="fas fa-cog"></i>
                <span>Shops</span>
            </div>
            <ul class="nav-children">
                <li>
                    <a href="{{route('users')}}">
                        Liste
                    </a>
                </li>
                <li>
                    <a href="{{route('storeTypesShow')}}">
                        Type
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-parent">
            <div class="nav-parent-container">
                <i class="fas fa-cog"></i>
                <span>Catégories</span>
            </div>

            <ul class="nav-children">
                <li>
                    <a href="#">
                        Nos catégories
                    </a>
                </li>
                <li>
                    <a href="#">
                        Autres
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-parent">
            <div class="nav-parent-container">
                <i class="fas fa-cog"></i>
                <span>Produits</span>
            </div>

            <ul class="nav-children">
                <li>
                    <a href="#">
                        Nos produits
                    </a>
                </li>
                <li>
                    <a href="#">
                        Allergènes
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-parent">
            <div class="nav-parent-container">
                <i class="fas fa-cog"></i>
                <span>Langues</span>
            </div>

            <ul class="nav-children">
                <li>
                    <a href="#">
                        Liste
                    </a>
                </li>
                <li>
                    <a href="#">
                        Traduction
                    </a>
                </li>
                <li>
                    <a href="#">
                        Langues 3
                    </a>
                </li>
                <li>
                    <a href="#">
                        Langues 4
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>

<div class="mout-tab-pane" id="mail">
    <h5 class="mout-tab-title">Emails</h5>
    <ul class="nav nav-pills nav-stacked nav-quirk">
        <li class="nav-parent">
            <a href="">
                <i class="fas fa-cog"></i>
                <span>Paramètres</span>
            </a>
            <ul class="nav-children">
                <li>
                    <a href="">
                        Param 1
                    </a>
                </li>
                <li>
                    <a href="">
                        Param 2
                    </a>
                </li>
                <li>
                    <a href="">
                        Param 3
                    </a>
                </li>
                <li>
                    <a href="">
                        Param 4
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
