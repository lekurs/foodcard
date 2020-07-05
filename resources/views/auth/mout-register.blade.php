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
            <h1>Bienvenue !</h1>
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                @include('flashes.errors')
                <div class="floating-label">
                    <input id="name" type="text" class="floating-input form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder=" " required autocomplete="name">
                    <label for="name" class="float form-control-label required">Votre nom</label>
                    <span class="highlight"></span>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="floating-label">
                    <input id="lastname" type="text" class="floating-input form-control @error('username') is-invalid @enderror" name="lastname" value="{{ old('username') }}" placeholder=" " required autocomplete="username">
                    <label for="lastname" class="float form-control-label required">Votre prénom</label>
                    <span class="highlight"></span>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="floating-label">
                    <input id="email" type="email" class="floating-input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder=" " required autocomplete="email">
                    <label for="email" class="float form-control-label required">Email</label>
                    <span class="highlight"></span>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="floating-label">
                    <input id="password" type="password" class="floating-input form-control @error('password') is-invalid @enderror" name="password" placeholder=" " required autocomplete="new-password">
                    <label for="password" class="float form-control-label required">{{ __('Password') }}</label>
                    <span class="highlight"></span>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="floating-label">
                    <input id="password-confirm" type="password" class="floating-input form-control" name="password_confirmation" placeholder=" " required autocomplete="new-password">
                    <label for="password-confirm" class="float form-control-label required">{{ __('Confirm Password') }}</label>
                    <span class="highlight"></span>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
        <div class="mout-public-login-right-panel">
            <h2 class="mout-public-login-logo-container">mout</h2>
        </div>
    </div>
</div>

</body>
</html>
