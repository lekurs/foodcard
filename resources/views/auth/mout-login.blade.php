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
                 viewBox="0 0 345.5 90.9" style="enable-background:new 0 0 345.5 90.9;" xml:space="preserve">
<style type="text/css">
    .st0-foodcard-logo{fill:#FFFFFF;}
    .st1-foodcard-logo{fill:#FFCD03;}
    .st2-foodcard-logo{fill:#E52421;}
    .st3-foodcard-logo{fill:#F07E19;}
</style>
                <g id="Groupe_260" transform="translate(-61.667 -62.705)">
                    <g id="Groupe_251" transform="translate(61.667 62.705)">
                        <path id="Tracé_14470" class="st0-foodcard-logo" d="M11.3,81.5c-2.5,0-4.6-2-4.6-4.5c0-2.5,2-4.6,4.5-4.6c3.3,0,6.1-2.2,6.9-5.3
			c0.1-0.6,0.2-1.1,0.3-1.7V41.1h-3.5c-2.5,0-4.5-2-4.5-4.5s2-4.5,4.5-4.5h3.5V21.8c0-1.7,0.3-3.3,0.8-4.9c1.2-4,4-7.4,7.8-9.4
			c2.4-1.2,5-1.8,7.6-1.8l0,0c2.5,0,4.6,2,4.6,4.5c0,2.5-2,4.6-4.5,4.6c-1.3,0-2.5,0.3-3.7,0.9c-0.9,0.5-1.6,1.3-2.2,2.1
			c-0.5,0.7-0.8,1.5-1,2.3c-0.1,0.6-0.2,1.1-0.3,1.7V32h4.1c2.5,0,4.5,2,4.5,4.5s-2,4.5-4.5,4.5h-4.1v24.2c0,1.7-0.3,3.3-0.8,4.9
			c-1.2,4-4,7.4-7.8,9.4C16.6,80.9,14,81.5,11.3,81.5L11.3,81.5z"/>
                    </g>
                    <g id="Groupe_252" transform="translate(179.437 62.724)">
                        <path id="Tracé_14471" class="st0-foodcard-logo" d="M29.8,65.5c-3.1,0-6.2-0.6-9.1-1.8c-2.7-1.2-5.2-2.8-7.3-5c-2.1-2.1-3.7-4.6-4.9-7.3
			c-2.4-5.7-2.4-12.1,0-17.8c1.2-2.7,2.9-5.2,5-7.3c2.1-2.1,4.6-3.8,7.3-5c2.8-1.2,5.8-1.9,8.8-1.9h0.1c3.4,0.1,6.8,1,9.8,2.7
			c1.5,0.8,2.9,1.8,4.2,2.9V10.1c0-1.2,0.5-2.4,1.3-3.2c1.8-1.7,4.6-1.7,6.4,0c0.9,0.9,1.3,2,1.3,3.2v32.5c0,3.1-0.6,6.3-1.8,9.1
			c-1.2,2.7-2.8,5.2-5,7.3c-2.1,2-4.6,3.7-7.3,4.8C35.9,64.9,32.9,65.5,29.8,65.5z M29.8,28.6c-1.9,0-3.7,0.4-5.4,1.1
			c-5.2,2.2-8.6,7.3-8.5,12.9c0,1.8,0.4,3.7,1.1,5.4c0.7,1.7,1.7,3.2,3,4.4c4,4,10,5.2,15.3,3c3.3-1.4,6-4.1,7.4-7.4
			c0.7-1.7,1.1-3.5,1.1-5.3c-0.1-1.9-0.5-3.8-1.3-5.6c-0.7-1.7-1.7-3.2-3-4.4C36.9,30,33.4,28.6,29.8,28.6L29.8,28.6z"/>
                    </g>
                    <g id="Groupe_253" transform="translate(229.531 76.517)">
                        <path id="Tracé_14472" class="st0-foodcard-logo" d="M29.7,51.7c-6,0-11.9-2.3-16.2-6.5c-2.1-2.1-3.8-4.5-5-7.2c-1.2-2.9-1.8-6-1.8-9.1
			c0-6.1,2.4-11.9,6.6-16.2c2.1-2.1,4.6-3.8,7.3-4.9c2.9-1.2,6-1.9,9.1-2h0c1.8,0,3.7,0.2,5.4,0.7c1.5,0.4,3,1,4.4,1.7
			c1.2,0.6,2.4,1.3,3.5,2.1c1,0.7,1.8,1.4,2.4,1.9c0.7,0.7,1.2,1.5,1.4,2.4c0.5,1.4,0.1,3-1,4c-1.8,1.7-4.6,1.7-6.4,0
			c-1.3-1.2-2.8-2.1-4.5-2.8c-5.2-2.1-11.2-1-15.1,3c-2.6,2.6-4.1,6.2-4.1,9.9c0,1.8,0.4,3.7,1.1,5.4c1.4,3.3,4.1,6,7.4,7.4
			c3.4,1.4,7.3,1.4,10.7,0c1.6-0.7,3.2-1.7,4.4-2.9c1.8-1.7,4.6-1.7,6.4,0c0.9,0.9,1.3,2.1,1.3,3.3c-0.1,1.3-0.6,2.5-1.5,3.4
			c-0.7,0.7-1.5,1.4-2.4,2c-1.1,0.8-2.3,1.5-3.6,2.1c-1.5,0.7-3,1.2-4.5,1.6C33.4,51.5,31.6,51.7,29.7,51.7z"/>
                    </g>
                    <g id="Groupe_254" transform="translate(270.875 76.418)">
                        <path id="Tracé_14473" class="st0-foodcard-logo" d="M48.3,51.8c-2.5,0-4.5-2-4.6-4.5c0,0,0,0,0,0v-1.1c-1.3,1.1-2.8,2.1-4.2,2.9
			c-5.8,3.1-12.6,3.4-18.6,0.8c-2.7-1.1-5.2-2.7-7.3-4.8c-2.1-2.1-3.8-4.5-5-7.3c-1.2-2.9-1.8-6-1.8-9.1c0-3.1,0.6-6.1,1.8-8.9
			c1.1-2.7,2.8-5.2,4.9-7.2c2.1-2.1,4.6-3.8,7.3-4.9c2.9-1.2,6-1.9,9.1-2c3.1-0.1,6.1,0.6,8.8,1.9c5.5,2.4,9.8,6.8,12.2,12.3
			c1.2,2.8,1.9,5.9,1.9,9v18.5C52.8,49.8,50.8,51.8,48.3,51.8C48.3,51.8,48.3,51.8,48.3,51.8L48.3,51.8z M29.7,14.8
			c-1.8,0-3.7,0.4-5.4,1.1c-3.4,1.4-6,4.1-7.4,7.5c-0.7,1.7-1.1,3.6-1.1,5.4c0,1.8,0.4,3.7,1.1,5.4c1.4,3.3,4.1,6,7.4,7.4
			c3.4,1.4,7.2,1.4,10.6,0c3.3-1.4,6-4,7.4-7.3c0.8-1.8,1.2-3.7,1.3-5.6c0-1.8-0.4-3.6-1.1-5.3c-1.4-3.4-4.1-6.1-7.5-7.5
			C33.4,15.2,31.6,14.8,29.7,14.8L29.7,14.8z"/>
                    </g>
                    <g id="Groupe_255" transform="translate(321.57 76.384)">
                        <path id="Tracé_14474" class="st0-foodcard-logo" d="M11.3,51.9c-2.5,0-4.5-2-4.5-4.5c0,0,0,0,0,0V28.6c0-3,0.6-6,1.8-8.8
			c1.1-2.7,2.8-5.2,4.9-7.3c4.2-4.3,9.9-6.8,16-6.9l0,0c1.3,0,2.6,0.4,3.5,1.3c1.8,1.7,1.9,4.5,0.2,6.3c-0.1,0.1-0.1,0.1-0.2,0.2
			c-1,0.9-2.2,1.3-3.5,1.3c-1.8,0.1-3.6,0.5-5.2,1.2c-1.6,0.7-3.1,1.7-4.4,3c-1.2,1.2-2.2,2.7-2.9,4.4c-0.7,1.7-1.1,3.5-1.1,5.3
			v18.8C15.9,49.9,13.9,51.9,11.3,51.9C11.3,51.9,11.3,51.9,11.3,51.9L11.3,51.9z"/>
                    </g>
                    <g id="Groupe_256" transform="translate(345.433 62.722)">
                        <path id="Tracé_14475" class="st0-foodcard-logo" d="M29.8,65.5c-6.1,0-12-2.4-16.3-6.8c-2.1-2.1-3.7-4.6-4.9-7.3c-2.4-5.7-2.4-12.1,0-17.8
			c1.2-2.7,2.9-5.2,5-7.3c2.1-2.1,4.6-3.8,7.3-5c2.8-1.2,5.8-1.9,8.8-1.9h0.1c3.4,0.1,6.8,1,9.8,2.7c1.5,0.8,2.9,1.8,4.2,2.9V10.2
			c0-1.2,0.5-2.4,1.3-3.2c1.8-1.7,4.6-1.7,6.4,0c0.9,0.8,1.3,2,1.3,3.2v32.5c0,3.1-0.6,6.3-1.8,9.1c-1.2,2.7-2.8,5.2-5,7.3
			c-2.1,2-4.6,3.7-7.3,4.8C35.9,64.9,32.9,65.5,29.8,65.5z M29.8,28.7c-1.9,0-3.7,0.4-5.4,1.1c-3.4,1.4-6.1,4.1-7.5,7.5
			c-0.7,1.7-1.1,3.6-1.1,5.4c0,1.8,0.4,3.7,1.1,5.4c3,7.1,11.2,10.4,18.3,7.4c1.7-0.7,3.2-1.7,4.4-3c1.3-1.3,2.3-2.8,3-4.4
			c0.7-1.7,1.1-3.5,1.1-5.3c-0.1-1.9-0.5-3.8-1.3-5.6c-0.7-1.7-1.7-3.2-3-4.4c-1.2-1.2-2.7-2.2-4.3-2.9C33.4,29,31.6,28.6,29.8,28.7
			z"/>
                    </g>
                    <g id="Groupe_257" transform="translate(94.877 78.229)">
                        <path id="Tracé_14478" class="st1-foodcard-logo" d="M84.7,16.9c-2.1-3.4-5-6.2-8.4-8.2c-7.2-4.1-15.9-4.1-23.1,0c-2.2,1.3-4.2,3-5.9,5
			c1,1,1.8,2.1,2.6,3.2c2.2,3.5,3.3,7.5,3.2,11.6c-0.1-2.3,0.5-4.6,1.6-6.7c1-1.8,2.5-3.2,4.2-4.2c3.6-1.9,7.9-1.9,11.5,0
			c1.8,1,3.3,2.4,4.3,4.2c2.2,4.2,2.2,9.2,0,13.4c-1,1.8-2.5,3.2-4.3,4.2c-3.6,1.9-7.9,1.9-11.5,0c-1.8-1-3.3-2.4-4.2-4.2
			c-1.1-2-1.7-4.4-1.6-6.7c0.1,4.1-1.1,8.1-3.2,11.6c-0.8,1.1-1.6,2.2-2.6,3.2c1.7,2,3.6,3.6,5.9,5c7.2,4.1,15.9,4.1,23.1,0
			c3.4-2,6.3-4.8,8.4-8.2C89,32.9,89,24,84.7,16.9L84.7,16.9z"/>
                        <path id="Tracé_14479" class="st2-foodcard-logo" d="M41.6,28.5c0.1,2.3-0.5,4.6-1.6,6.7c-1,1.8-2.5,3.2-4.3,4.2c-3.6,1.9-7.9,1.9-11.5,0
			c-1.8-1-3.3-2.4-4.2-4.2c-2.1-4.2-2.1-9.2,0-13.4c1-1.8,2.5-3.2,4.2-4.2c3.6-1.9,7.9-1.9,11.5,0c1.8,1,3.3,2.4,4.3,4.2
			C41.1,23.9,41.6,26.2,41.6,28.5c-0.1-4.1,1-8.1,3.2-11.6c0.8-1.2,1.6-2.2,2.6-3.2c-1.7-2-3.6-3.6-5.8-5c-7.2-4.1-15.9-4.1-23.1,0
			c-3.5,2-6.4,4.8-8.4,8.2c-4.2,7.1-4.2,16,0,23.2c2.1,3.4,5,6.2,8.4,8.2c7.2,4.1,15.9,4.1,23.1,0c2.2-1.3,4.2-3,5.8-5
			c-1-1-1.8-2.1-2.6-3.2C42.6,36.6,41.5,32.6,41.6,28.5z"/>
                        <path id="Tracé_14480" class="st3-foodcard-logo" d="M53.1,28.5c0.1-4.1-1.1-8.1-3.2-11.6c-0.8-1.2-1.6-2.2-2.6-3.2c-1,1-1.8,2.1-2.6,3.2
			c-4.2,7.1-4.2,16,0,23.2c0.8,1.1,1.6,2.2,2.6,3.2c1-1,1.8-2.1,2.6-3.2C52.1,36.6,53.2,32.6,53.1,28.5z"/>
                    </g>
                </g>
            </svg>
        </div>
    </div>
</div>
</body>
</html>
