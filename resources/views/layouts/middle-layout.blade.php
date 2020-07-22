<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <title>Foodcard - @yield('title')</title>
    @yield('styles')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    {{-- vendors--}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap-reboot.min.css')}}">

    {{-- /vendors--}}

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
    @yield('header')
</header>

<section>
    <div class="mout-admin-middle-container">
    @include('flashes.flash-message')
    @section('navigation')
        <div class="container-fluid">
            <div class="mout-admin-middle-content">
                <div class="mout-admin-middle-user-informations-container">
                    <div class="test-fix">
                        <p class="mout--regular mout-admin-middle-user-description">Bienvenue <span class="userlogs">{{auth()->user()->name . ' ' . auth()->user()->lastname}}</span>
                            <a href="{{route('logout')}}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fal fa-user-times"></i></a></p>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <div class="mout-admin-middle-store-informations-container">
                            <div class="mout-admin-middle-store-icon-container">
                                <i class="fal fa-map-marker-alt fa-3x"></i>
                            </div>
                            <div class="mout-admin-middle-store-description">
                                <h4 class="mout--regular" id="mout-admin-middle-store-title">Restaurant</h4>
                                <p class="mout--regular" id="store-name">{{session('store')->name}}</p>
                                <p class="mout--light" id="store-address">{{session('store')->address}}</p>
                                <p class="mout--light" id="store-zip-city">{{session('store')->zip . ' ' . session('store')->city}}</p>
                                <p class="mout--light" id="store-phone">{{auth()->user()->phone}}</p>

                                @if(count($stores) > 1)
                                    <p class="mout--light" id="store-change" data-toggle="modal" data-target="#changeStore"><i class="fal fa-store"></i> Changer de magasin</p>
                                @endif
                                <p class="mout--regular text-break" id="store-mail">{{auth()->user()->email}}</p>
                                <p class="edit-store" data-store=""><span class="mout-middle-edit-magic-icon"><i class="fal fa-magic"></i></span></p>
                                @show

                            </div>
                        </div>
                    </div>
                </div>

                <div class="mout-admin-middle-main-panel">
                    @yield('body')
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="changeStore" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
{{--            <form action="#" method="post">--}}
            <div class="modal-body">
                <div class="form-group">
                    <select name="changeStore" id="change-store">
                        @foreach($stores as $store)
                            <option value="{{$store->id}}">{{$store->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Voir ce magasin</button>
            </div>
{{--            </form>--}}
        </div>
    </div>
</div>

<script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

<script src="{{asset('js/admin/bo-mout-nav-bar.js')}}"></script>
@yield('js')

</body>
</html>
