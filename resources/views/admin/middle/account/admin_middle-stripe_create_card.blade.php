@extends('layouts.middle-layout')
@section('title', ' Bienvenue')

@section('header')
    <div class="mout-admin-middle-header-container" id="store"
         style="background-image:url('@if( isset($store) && !empty($medias['illustration']) ){{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/background/' . $medias['illustration']->path)}}@else {{ asset('/images/header-store.jpg') }}@endif') ">
        @if( isset($store) && !empty($medias) )
            <img src="{{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/' . $medias['logo']->path)}}" alt="{{$store->name}}" class="img-fluid">
        @else
            <h2 class="mout-admin-middle-store-name mout--regular">{{request()->session()->get('store')->name}}</h2>
        @endif

        <div class="mout-admin-middle-header-nav-ariane" id="account">
            <i class="fal fa-home"></i>
            <p>mon compte</p>
        </div>
    </div>
@endsection
@section('navigation')
    @parent
    <div class="mout-admin-middle-nav-buttons-container">
        <a href="{{route('adminMiddleStoreShow')}}" class="btn mout-admin-middle-nav-buttons btn-store"><i
                class="fal fa-home"></i></a>
        <a href="{{route('adminMiddleMenuShow')}}" class="btn mout-admin-middle-nav-buttons btn-menu"><i
                class="fal fa-concierge-bell"></i></a>
    </div>
@endsection

@section('body')
    <div class="mout-admin-middle-content-panel">
        <h4 class="mout--regular">Ajouter une nouvelle carte de crédit</h4>
        <form id="add-payment" action="{{ route('stripeStorePaymentMethod') }}" method="post">
            @csrf

            <div class="cell foodcard-stripe foodcard-stripe2" id="foodcard-stripe-2">
                <div data-locale-reversible>
                    <div class="row" data-locale-reversible>
                        <div class="field">
                            <input id="foodcard-stripe2-name"
                                   name="name"
                                   data-tid="elements_foodcard-stripes.form.name_placeholder"
                                   class="input empty"
                                   type="text" placeholder="Starck"
                                   required=""
                                   autocomplete="name-level2">
                            <label for="foodcard-stripe2-name"
                                   data-tid="elements_foodcard-stripes.form.name_label">Nom</label>
                            <div class="baseline"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="field">
                            <div id="foodcard-stripe2-card-number" class="input empty"></div>
                            <label for="foodcard-stripe2-card-number"
                                   data-tid="elements_foodcard-stripes.form.card_number_label">Numéro de carte</label>
                            <div class="baseline"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="field half-width">
                            <div id="foodcard-stripe2-card-expiry" class="input empty"></div>
                            <label for="foodcard-stripe2-card-expiry"
                                   data-tid="elements_foodcard-stripes.form.card_expiry_label">Expiration</label>
                            <div class="baseline"></div>
                        </div>
                        <div class="field quarter-width">
                            <div id="foodcard-stripe2-card-cvc" class="input empty"></div>
                            <label for="foodcard-stripe2-card-cvc"
                                   data-tid="elements_foodcard-stripes.form.card_cvc_label">CVC</label>
                            <div class="baseline"></div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn mout-btn-login btn-add-payment" id="add-credit-card">Ajouter</button>
        </form>
    </div>
@endsection
@section('js')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const elementStyles = {
            base: {
                color: '#32325D',
                fontWeight: 500,
                fontFamily: 'Source Code Pro, Consolas, Menlo, monospace',
                fontSize: '16px',
                fontSmoothing: 'antialiased',

                '::placeholder': {
                    color: '#CFD7DF',
                },
                ':-webkit-autofill': {
                    color: '#e39f48',
                },
            },
            invalid: {
                color: '#E25950',

                '::placeholder': {
                    color: '#FFCCA5',
                },
            },
        };
        const elementClasses = {
            focus: 'focused',
            empty: 'empty',
            invalid: 'invalid',
        };

        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements({locale: 'fr'});

        const cardNumber = elements.create('cardNumber', {
            style: elementStyles,
            classes: elementClasses,
        });
        cardNumber.mount('#foodcard-stripe2-card-number');

        const cardExpiry = elements.create('cardExpiry', {
            style: elementStyles,
            classes: elementClasses,
        });
        cardExpiry.mount('#foodcard-stripe2-card-expiry');

        const cardCvc = elements.create('cardCvc', {
            style: elementStyles,
            classes: elementClasses,
        });
        cardCvc.mount('#foodcard-stripe2-card-cvc');

        function stripeTokenHandler(token) {
            var form = document.getElementById('add-payment');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }

        function createToken() {
            stripe.createToken(cardNumber).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        }

        // Create a token when the form is submitted.
        var form = document.getElementById('add-payment');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            createToken();
        });

    </script>
@endsection
