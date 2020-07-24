<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mout - @yield('title')</title>
    @yield('styles')
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    {{-- vendors--}}
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/content-tools/content-tools.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/content-tools/sandbox.css')}}">
    <link rel="stylesheet" href="{{asset('css/nestable.css')}}">

    {{-- /vendors--}}
    <link rel="stylesheet" href="{{asset('images/mout/AristaProAlternate-Regular.css')}}">
    <link rel="stylesheet" href="{{asset('images/mout/AristaProAlternate-Hairline.css')}}">
    <link rel="stylesheet" href="{{asset('images/mout/AristaProAlternate-Light.css')}}">
    <link rel="stylesheet" href="{{asset('images/mout/AristaProAlternate-Fat.css')}}">

    <link href="https://fonts.googleapis.com/css?family=Assistant:200,300,400,600,700,800|Playfair+Display:400,700" rel="stylesheet">
    <script src="https://kit.fontawesome.com/dd86c136c7.js" crossorigin="anonymous"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="CWBmo27pZiQFjXYjnIL8j2XbLvt3abSjWgL-DGdsQ94" />

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
<div class="container-fluid">
    <div class="mout-public-login-container">
        <div class="mout-public-login-left-panel">
            <i class="fal fa-home welcome-register"></i>
            <h1 class="mout--regular">Bienvenue dans <br> votre espace client</h1>
            <form method="POST" action="{{ route('login') }}" name="loginform" id="loginform">
                @csrf
                <div class="floating-label">
                    <input id="email" type="email" class="floating-input form-control @error('email') is-invalid @enderror" name="email" autocomplete="email" placeholder=" " required>
                    <label for="email" class="float form-control-label required">Email</label>
                    <span class="highlight"></span>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="floating-label">
                    <input id="password" type="password" class="floating-input form-control @error('password') is-invalid @enderror" name="password" placeholder=" "  required autocomplete="current-password">
                    <label for="password" class="float form-control-label required">Password</label>
                    <span class="highlight"></span>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group remember-me">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Se souvenir de moi ?</label>
                </div>

                <div class="form-group connection-group">
                    <button type="submit" class="btn mout-btn-login mout--regular">
                        Connexion
                    </button>
                    <a href="{{route('register')}}" class="btn mout--regular mout-btn-register">je crée mon compte</a>
                </div>

                <div class="form-group password-forget">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
        <div class="mout-public-login-right-panel">
            <svg version="1.1" id="foodcard-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 92.1 27.9" style="enable-background:new 0 0 92.1 27.9;" xml:space="preserve">
                <style type="text/css">
                    .st0{fill:#001F78;}
                    .st1{fill:#000691;}
                    .st2{fill:#00C332;}
                    .st3{fill:none;}
                    .st4{fill:#FFCD00;}
                    .st5{fill:#FF0000;}
                    .st6{fill:#FF7F00;}
                </style>
                                <g>
                                    <path class="st0" d="M6.6,23.4c-0.3,0-0.6-0.1-0.8-0.3c-0.2-0.2-0.3-0.5-0.3-0.8c0-0.3,0.1-0.6,0.3-0.8c0.2-0.2,0.5-0.3,0.8-0.3
                        c0.4,0,0.7-0.1,0.9-0.2c0.2-0.2,0.4-0.3,0.5-0.5c0.1-0.2,0.2-0.4,0.3-0.6c0.1-0.3,0.1-0.4,0.1-0.4v-6H7.5c-0.3,0-0.6-0.1-0.8-0.3
                        s-0.3-0.5-0.3-0.8c0-0.3,0.1-0.6,0.3-0.8c0.2-0.2,0.5-0.3,0.8-0.3h0.9V8.5c0-0.4,0.1-0.8,0.2-1.2C8.7,6.9,9,6.4,9.3,6
                        c0.3-0.4,0.7-0.8,1.2-1c0.5-0.3,1.1-0.4,1.9-0.4c0,0,0,0,0,0c0.3,0,0.6,0.1,0.8,0.3c0.2,0.2,0.3,0.5,0.3,0.8c0,0.3-0.1,0.6-0.3,0.8
                        c-0.2,0.2-0.5,0.3-0.8,0.3c-0.4,0-0.7,0.1-0.9,0.2c-0.2,0.2-0.4,0.3-0.5,0.5c-0.1,0.2-0.2,0.4-0.3,0.6c-0.1,0.3-0.1,0.4-0.1,0.4
                        v2.6h1c0.3,0,0.6,0.1,0.8,0.3c0.2,0.2,0.3,0.5,0.3,0.8c0,0.3-0.1,0.6-0.3,0.8s-0.5,0.3-0.8,0.3h-1v6c0,0.4-0.1,0.8-0.2,1.2
                        c-0.1,0.5-0.4,0.9-0.7,1.3c-0.3,0.4-0.7,0.8-1.2,1C8,23.2,7.4,23.4,6.6,23.4L6.6,23.4z"/>
                                </g>
                                <g>
                                    <path class="st1" d="M40.5,19.4c-0.8,0-1.6-0.2-2.3-0.5c-0.7-0.3-1.3-0.7-1.8-1.2c-0.5-0.5-0.9-1.1-1.2-1.8
                        c-0.3-0.7-0.5-1.4-0.5-2.2c0-0.8,0.2-1.5,0.5-2.2c0.3-0.7,0.7-1.3,1.2-1.8c0.5-0.5,1.1-0.9,1.8-1.2C38.9,8.1,39.7,8,40.4,8
                        c0,0,0,0,0,0c0.9,0,1.7,0.3,2.4,0.7c0.4,0.2,0.7,0.5,1,0.7V5.7c0-0.3,0.1-0.6,0.3-0.8c0.4-0.4,1.2-0.4,1.6,0
                        c0.2,0.2,0.3,0.5,0.3,0.8v8.1c0,0.8-0.2,1.6-0.5,2.3c-0.3,0.7-0.7,1.3-1.2,1.8c-0.5,0.5-1.1,0.9-1.8,1.2
                        C42,19.3,41.2,19.4,40.5,19.4z M40.5,10.3c-0.5,0-0.9,0.1-1.3,0.3c-0.4,0.2-0.8,0.4-1.1,0.7c-0.3,0.3-0.6,0.7-0.7,1.1
                        c-0.2,0.4-0.3,0.9-0.3,1.3s0.1,0.9,0.3,1.3c0.2,0.4,0.4,0.8,0.7,1.1c0.3,0.3,0.7,0.6,1.1,0.7c0.8,0.4,1.9,0.4,2.7,0
                        c0.4-0.2,0.8-0.4,1.1-0.7c0.3-0.3,0.6-0.7,0.7-1.1c0.2-0.4,0.3-0.9,0.3-1.3c0-0.5-0.1-1-0.3-1.4c-0.2-0.4-0.4-0.8-0.7-1.1
                        c-0.3-0.3-0.7-0.5-1.1-0.7C41.4,10.3,40.9,10.3,40.5,10.3z"/>
                                </g>
                                <g>
                                    <path class="st2" d="M52.9,19.4c-0.8,0-1.5-0.1-2.2-0.4c-0.7-0.3-1.3-0.7-1.8-1.2c-0.5-0.5-0.9-1.1-1.2-1.8
                        c-0.3-0.7-0.5-1.5-0.5-2.3c0-0.8,0.1-1.5,0.4-2.2c0.3-0.7,0.7-1.3,1.2-1.8c0.5-0.5,1.1-0.9,1.8-1.2C51.3,8.2,52.1,8,52.9,8
                        c0,0,0,0,0,0c0.5,0,0.9,0.1,1.3,0.2c0.4,0.1,0.8,0.3,1.1,0.4c0.3,0.2,0.6,0.3,0.9,0.5c0.2,0.2,0.4,0.3,0.6,0.5
                        c0.1,0.1,0.3,0.3,0.4,0.6c0.1,0.4,0,0.7-0.3,1c-0.4,0.4-1.2,0.4-1.6,0c-0.3-0.3-0.7-0.5-1.1-0.7c-0.8-0.3-1.8-0.3-2.7,0
                        c-0.4,0.2-0.8,0.4-1.1,0.7c-0.3,0.3-0.6,0.7-0.7,1.1c-0.2,0.4-0.3,0.9-0.3,1.3c0,0.5,0.1,0.9,0.3,1.3c0.2,0.4,0.4,0.8,0.7,1.1
                        c0.3,0.3,0.7,0.6,1.1,0.7c0.8,0.4,1.9,0.4,2.7,0c0.4-0.2,0.8-0.4,1.1-0.7c0.4-0.4,1.2-0.4,1.6,0c0.2,0.2,0.3,0.5,0.3,0.8
                        c0,0.3-0.1,0.6-0.4,0.8c-0.1,0.1-0.3,0.3-0.6,0.5c-0.3,0.2-0.6,0.4-0.9,0.5c-0.3,0.2-0.7,0.3-1.1,0.4
                        C53.8,19.3,53.4,19.4,52.9,19.4z"/>
                                </g>
                                <g>
                                    <path class="st2" d="M67.7,19.4c-0.3,0-0.6-0.1-0.8-0.3c-0.2-0.2-0.3-0.5-0.3-0.8V18c-0.3,0.3-0.7,0.5-1.1,0.7
                        c-1.4,0.8-3.2,0.8-4.6,0.2c-0.7-0.3-1.3-0.7-1.8-1.2c-0.5-0.5-0.9-1.1-1.2-1.8c-0.3-0.7-0.5-1.5-0.5-2.3c0-0.8,0.1-1.5,0.4-2.2
                        c0.3-0.7,0.7-1.3,1.2-1.8c0.5-0.5,1.1-0.9,1.8-1.2c0.7-0.3,1.5-0.5,2.3-0.5c0.7,0,1.5,0.2,2.2,0.5c0.7,0.3,1.3,0.7,1.8,1.2
                        c0.5,0.5,0.9,1.1,1.2,1.8c0.3,0.7,0.5,1.4,0.5,2.2v4.6c0,0.3-0.1,0.6-0.3,0.8C68.3,19.3,68.1,19.4,67.7,19.4z M63.1,10.2
                        c-0.5,0-0.9,0.1-1.3,0.3c-0.4,0.2-0.8,0.4-1.1,0.7c-0.3,0.3-0.6,0.7-0.7,1.1c-0.2,0.4-0.3,0.9-0.3,1.3c0,0.5,0.1,0.9,0.3,1.3
                        c0.2,0.4,0.4,0.8,0.7,1.1c0.3,0.3,0.7,0.6,1.1,0.7c0.8,0.4,1.8,0.4,2.6,0c0.4-0.2,0.8-0.4,1.1-0.7c0.3-0.3,0.6-0.7,0.8-1.1
                        c0.2-0.4,0.3-0.9,0.3-1.4c0-0.4-0.1-0.9-0.3-1.3c-0.2-0.4-0.4-0.8-0.7-1.1c-0.3-0.3-0.7-0.6-1.1-0.7C64.1,10.3,63.6,10.2,63.1,10.2
                        z"/>
                                </g>
                                <g>
                                    <path class="st2" d="M71.2,19.4c-0.3,0-0.6-0.1-0.8-0.3c-0.2-0.2-0.3-0.5-0.3-0.8v-4.7c0-0.8,0.1-1.5,0.4-2.2
                        c0.3-0.7,0.7-1.3,1.2-1.8c0.5-0.5,1.1-0.9,1.8-1.2c0.7-0.3,1.4-0.5,2.2-0.5l0,0c0.4,0,0.7,0.1,0.9,0.3c0.2,0.2,0.3,0.5,0.3,0.8
                        s-0.1,0.6-0.3,0.8c-0.2,0.2-0.5,0.3-0.9,0.3c-0.4,0-0.9,0.1-1.3,0.3c-0.4,0.2-0.8,0.4-1.1,0.7c-0.3,0.3-0.5,0.7-0.7,1.1
                        c-0.2,0.4-0.3,0.9-0.3,1.3v4.7c0,0.3-0.1,0.6-0.3,0.8C71.7,19.3,71.5,19.4,71.2,19.4z"/>
                                </g>
                                <g>
                                    <path class="st2" d="M81.7,19.4c-0.8,0-1.6-0.2-2.3-0.5c-0.7-0.3-1.3-0.7-1.8-1.2c-0.5-0.5-0.9-1.1-1.2-1.8
                        c-0.3-0.7-0.5-1.4-0.5-2.2c0-0.8,0.2-1.5,0.5-2.2c0.3-0.7,0.7-1.3,1.2-1.8c0.5-0.5,1.1-0.9,1.8-1.2C80.2,8.1,80.9,8,81.6,8
                        c0,0,0,0,0,0c0.9,0,1.7,0.3,2.4,0.7c0.4,0.2,0.7,0.5,1,0.7V5.7c0-0.3,0.1-0.6,0.3-0.8c0.4-0.4,1.2-0.4,1.6,0
                        c0.2,0.2,0.3,0.5,0.3,0.8v8.1c0,0.8-0.2,1.6-0.5,2.3c-0.3,0.7-0.7,1.3-1.2,1.8c-0.5,0.5-1.1,0.9-1.8,1.2
                        C83.2,19.3,82.5,19.4,81.7,19.4z M81.7,10.3c-0.5,0-0.9,0.1-1.3,0.3c-0.4,0.2-0.8,0.4-1.1,0.7c-0.3,0.3-0.6,0.7-0.7,1.1
                        c-0.2,0.4-0.3,0.9-0.3,1.3s0.1,0.9,0.3,1.3c0.2,0.4,0.4,0.8,0.7,1.1c0.3,0.3,0.7,0.6,1.1,0.7c0.8,0.4,1.9,0.4,2.7,0
                        c0.4-0.2,0.8-0.4,1.1-0.7c0.3-0.3,0.6-0.7,0.7-1.1c0.2-0.4,0.3-0.9,0.3-1.3c0-0.5-0.1-1-0.3-1.4c-0.2-0.4-0.4-0.8-0.7-1.1
                        c-0.3-0.3-0.7-0.5-1.1-0.7C82.6,10.3,82.2,10.3,81.7,10.3z"/>
                                </g>
                                <g>
                                    <path class="st3" d="M20.9,11.4C20.5,11.1,20,11,19.5,11s-1,0.1-1.4,0.4c-0.4,0.2-0.8,0.6-1.1,1c-0.3,0.5-0.4,1-0.4,1.7
                        c0,0.7,0.1,1.2,0.4,1.7c0.3,0.5,0.6,0.8,1.1,1c0.4,0.2,0.9,0.4,1.4,0.4s1-0.1,1.4-0.4s0.8-0.6,1.1-1s0.4-1,0.4-1.7
                        c0-0.7-0.1-1.2-0.4-1.7C21.7,12,21.3,11.6,20.9,11.4z"/>
                                    <path class="st3" d="M26.7,16.8c0.4,0.2,0.9,0.4,1.4,0.4c0.5,0,1-0.1,1.4-0.4c0.4-0.2,0.8-0.6,1.1-1s0.4-1,0.4-1.7
                        c0-0.7-0.1-1.2-0.4-1.7c-0.3-0.5-0.6-0.8-1.1-1c-0.4-0.2-0.9-0.4-1.4-0.4c-0.5,0-1,0.1-1.4,0.4c-0.4,0.2-0.8,0.6-1.1,1
                        c-0.3,0.5-0.4,1-0.4,1.7c0,0.7,0.1,1.2,0.4,1.7C25.9,16.2,26.3,16.5,26.7,16.8z"/>
                                    <path class="st4" d="M33.1,11.2c-0.5-0.9-1.2-1.5-2.1-2c-0.9-0.5-1.8-0.8-2.9-0.8c-1,0-2,0.3-2.9,0.8c-0.6,0.3-1,0.8-1.5,1.2
                        c0.2,0.3,0.5,0.5,0.6,0.8c0.5,0.9,0.8,1.8,0.8,2.9c0-0.7,0.1-1.2,0.4-1.7c0.3-0.5,0.6-0.8,1.1-1c0.4-0.2,0.9-0.4,1.4-0.4
                        c0.5,0,1,0.1,1.4,0.4c0.4,0.2,0.8,0.6,1.1,1c0.3,0.5,0.4,1,0.4,1.7c0,0.7-0.1,1.2-0.4,1.7s-0.6,0.8-1.1,1c-0.4,0.2-0.9,0.4-1.4,0.4
                        c-0.5,0-1-0.1-1.4-0.4c-0.4-0.2-0.8-0.6-1.1-1c-0.3-0.5-0.4-1-0.4-1.7c0,1.1-0.3,2-0.8,2.9c-0.2,0.3-0.4,0.5-0.6,0.8
                        c0.4,0.5,0.9,0.9,1.5,1.2c0.9,0.5,1.8,0.8,2.9,0.8c1,0,2-0.3,2.9-0.8c0.9-0.5,1.6-1.2,2.1-2s0.8-1.8,0.8-2.9S33.6,12.1,33.1,11.2z"
                                    />
                                    <path class="st5" d="M22.4,14.1c0,0.7-0.1,1.2-0.4,1.7s-0.6,0.8-1.1,1s-0.9,0.4-1.4,0.4s-1-0.1-1.4-0.4c-0.4-0.2-0.8-0.6-1.1-1
                        c-0.3-0.5-0.4-1-0.4-1.7c0-0.7,0.1-1.2,0.4-1.7c0.3-0.5,0.6-0.8,1.1-1c0.4-0.2,0.9-0.4,1.4-0.4s1,0.1,1.4,0.4s0.8,0.6,1.1,1
                        C22.2,12.9,22.4,13.4,22.4,14.1c0-1.1,0.3-2,0.8-2.9c0.2-0.3,0.4-0.6,0.6-0.8c-0.4-0.5-0.9-0.9-1.5-1.2c-0.9-0.5-1.8-0.8-2.9-0.8
                        c-1,0-2,0.3-2.9,0.8c-0.9,0.5-1.6,1.2-2.1,2s-0.8,1.8-0.8,2.9s0.3,2,0.8,2.9s1.2,1.5,2.1,2c0.9,0.5,1.8,0.8,2.9,0.8
                        c1,0,2-0.3,2.9-0.8c0.6-0.3,1-0.8,1.5-1.2c-0.2-0.3-0.5-0.5-0.6-0.8C22.6,16.1,22.4,15.1,22.4,14.1z"/>
                                    <path class="st6" d="M25.2,14.1c0-1.1-0.3-2-0.8-2.9c-0.2-0.3-0.4-0.6-0.6-0.8c-0.2,0.3-0.5,0.5-0.6,0.8c-0.5,0.9-0.8,1.8-0.8,2.9
                        s0.3,2,0.8,2.9c0.2,0.3,0.4,0.5,0.6,0.8c0.2-0.3,0.5-0.5,0.6-0.8C25,16.1,25.2,15.1,25.2,14.1z"/>
                                </g>
                </svg>
        </div>
    </div>
</div>
</body>
</html>
