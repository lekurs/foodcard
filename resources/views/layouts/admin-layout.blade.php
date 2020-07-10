<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>FoodCard - @yield('title')</title>
    @yield('styles')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    {{-- vendors--}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap-reboot.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('css/content-tools/content-tools.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/content-tools/sandbox.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/nestable.css')}}">

    {{-- /vendors--}}
{{--    <link rel="stylesheet" href="{{asset('images/mout/AristaProAlternate-Regular.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('images/mout/AristaProAlternate-Hairline.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('images/mout/AristaProAlternate-Light.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('images/mout/AristaProAlternate-Fat.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('vendor/colorpicker/color-picker.css')}}">--}}

    <link href="https://fonts.googleapis.com/css?family=Assistant:200,300,400,600,700,800|Playfair+Display:400,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/dd86c136c7.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.tiny.cloud/1/jzzmbwdr1zecf3rqasg7irasq2pbv5ys2tsh9l44n4iy2vbm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('meta')
    <meta name="description" content="description du site" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @section('social')
    <!-- Création des metatags réseaux sociaux -->
    <!-- Metatags FB -->
    <meta property="og:title" content="Mout Web Agency" />
    <meta property="og:type" content="Mout Web Agency" />
    <meta property="og:url" content="moutwebdesign.com" />
    <meta property="og:description" content="Mout Web Agency" />
    <meta property="og:image" content="{{ asset('assets/images/logo/bandeau-mout.png') }}" />

    <!-- Metatag Twitter -->
    <meta name="twitter:card" content="Mout Web Agency" />
    <meta name="twitter:tittle" content="Mout Web Agency" />
    <meta name="twitter:description" content="Mout Web Agency" />
    @endsection
</head>
<body>
<header>
    <div class="mout-header-panel">
        <div class="mout-logo-panel">
            <h2>
                <a href="{{ route('admin') }}" class="mout-logo-panel-link">FoodCard</a>
            </h2>
        </div>
        <div class="mout-header-bar">
            <div class="header-bar-right">
                <ul class="header-bar-right-menu">
                    <li class="header-bar-right-menu-list">
                        <div class="btn-group">
                            <button type="button" class="btn"></button><a href="{{ route('admin') }}"><i class="fas fa-home"></i></a>
                        </div>
                    </li>
                    <li class="header-bar-right-menu-list">
                        <div class="btn-group dropdown-nav">
                            <button class="btn btn-logged" id="logged-dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('assets/images/uploads/users/' . strtolower(auth()->user()->name) . strtolower(auth()->user()->lastname)) }}" alt="{{auth()->user()->lastname . ' ' . auth()->user()->name}}" class="img-fluid mout-login-portrait">
                                {{auth()->user()->lastname . ' ' . auth()->user()->name}}
                                <span class="mout-log-arrow"></span>
                            </button>
                            <ul class="drop-menu pull-right">
                                <li>
                                    <a href="{{route('logout')}}">logout</a>
                                </li>
                                <li>
                                    <a href="#">2</a>
                                </li>
                                <li>
                                    <a href="#">3</a>
                                </li>
                                <li>
                                    <a href="#">4</a>
                                </li>
                                <li>
                                    <a href="#">5</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<section>
    <div class="mout-left-panel">
        <div class="mout-left-panel-informations">
            <div class="mout-left-panel-profil">
                <div class="mout-profil-left">
                @if(auth()->user()->roles == "Admin")
                    <img src="{{ asset('assets/images/uploads/users/clairegindre.png') }}" alt="{{auth()->user()->username}} {{auth()->user()->name}}" class="img-fluid img-portrait-bo-left-side">
                @endif
                </div>
                <div class="mout-profil-right">
                    <h4 class="mout-profil-name">{{auth()->user()->username}} <span class="text-uppercase">{{auth()->user()->name}}</span>
                        <a href="{{route('logout')}}"><i class="fas fa-user-times" style="color: #ffffff"></i></a></h4>
                    <span>{{auth()->user()->roles}}</span>
                </div>
            </div>
            <!-- TAB PANEL TOP -->
                @include('admin.nav._tab-panel-top')
            <!-- /TAB PANEL TOP -->

            <!-- TAB PANEL BOT -->
            <div class="mout-tab-content">
                @include('admin.nav._nav-pills-with-parent')
            </div>
            <!-- /TAB PANEL BOT -->
        </div>
    </div>

    <div class="mout-main-panel">
        <div class="mout-content-panel">
            @include('flashes.flash-message')
            @yield('body')

        </div>
    </div>
</section>
<script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="{{asset('vendor/nestable/nestable.js')}}"></script>

<script src="{{asset('js/admin/bo-mout-nav-bar.js')}}"></script>
@yield('js')

</body>
</html>
