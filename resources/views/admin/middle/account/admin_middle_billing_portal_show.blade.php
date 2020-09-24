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
            @if( !empty($paymentMethods ))
            <h4 class="mout--regular">Mon mode de paiement</h4>
            <div class="mout-admin-middle-users-container" id="payment-informations">
                <div class="mout-admin-middle-users-manager" id="credit-card-container">
                    @foreach($paymentMethods as $paymentMethod)
                    <div data-card="{{ $paymentMethod->card->last4 }}" data-date="{{ $paymentMethod->card->exp_month }}/{{ $paymentMethod->card->exp_year }}" data-name="@isset($customer) {{ $customer->name }} @endisset" data-type="{{ $paymentMethod->card->brand }}" class="card"></div>
                    @endforeach
                    <a href="{{ route('stripeAddCreditCard') }}" class="btn mout-btn-login btn-add-payment">Ajouter un moyen de paiement</a>
                </div>
                <div class="mout-admin-middle-usercards-container">
                        @foreach($subscriptions as $subscription)
                        <div class="mout-middle-admin-usercards">
                            <p class="mout--regular">{{ $subscription->plan->nickname }}</p>
                            <p>Début : {{ Carbon\Carbon::createFromTimestamp($subscription->current_period_start)->translatedFormat('d/m/Y') }}</p>
                            <p>Fin : {{ Carbon\Carbon::createFromTimestamp($subscription->current_period_end)->translatedFormat('d/m/Y') }}</p>
                            <p>Prix : {{ $subscription->plan->amount_decimal }}</p>
                            <a href="{{ route('stripeEditSubscription') }}" class="btn mout-btn-login">Changer ma formule</a>
                    </div>
                        @endforeach
                </div>
            </div>
            @else
            <div class="mout-admin-middle-stripe-payment">
            <h4 class="mout--regular">Choisir ma formule</h4>
            <div class="mout-admin-middle-stripe-container">
                <div class="mout-admin-middle-container">
                    <form id="payment-form" action="{{ route('adminMiddleBillingPortalSubscribe') }}" method="post">
                        @csrf
                        <div class="row amount-container">
                            @foreach($subscribes as $key => $subcribe)
                                <input type="radio" name="amount" id="amount-{{ $subcribe }}" value="{{ $key }}" class="payment-amount"">
                                <label for="amount-{{ $subcribe }}" data-value="{{ $subcribe }}" id="{{ $key }}">{{ $subcribe }}</label>
                            @endforeach
                        </div>
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
                                        <input id="foodcard-stripe2-email"
                                               name="email"
                                               data-tid="elements_foodcard-stripes.form.email_placeholder"
                                               class="input empty"
                                               type="email" placeholder="Email" required=""
                                               autocomplete="email-line1">
                                        <label for="foodcard-stripe2-email" data-tid="elements_foodcard-stripes.form.email_label">Email</label>
                                        <div class="baseline"></div>
                                    </div>
                                </div>
                                <div data-locale-reversible>
                                    <div class="row">
                                        <div class="field">
                                            <input id="foodcard-stripe2-address"
                                                   name="address"
                                                   data-tid="elements_foodcard-stripes.form.address_placeholder"
                                                   class="input empty"
                                                   type="text" placeholder="Mon adresse" required=""
                                                   autocomplete="address-line1">
                                            <label for="foodcard-stripe2-address" data-tid="elements_foodcard-stripes.form.address_label">Adresse</label>
                                            <div class="baseline"></div>
                                        </div>
                                    </div>
                                    <div class="row" data-locale-reversible>
                                        <div class="field half-width">
                                            <input id="foodcard-stripe2-city"
                                                   name="city"
                                                   data-tid="elements_foodcard-stripes.form.city_placeholder"
                                                   class="input empty"
                                                   type="text" placeholder="San Francisco"
                                                   required=""
                                                   autocomplete="address-level2">
                                            <label for="foodcard-stripe2-city"
                                                   data-tid="elements_foodcard-stripes.form.city_label">Ville</label>
                                            <div class="baseline"></div>
                                        </div>
                                        <div class="field quarter-width">
                                            <input id="foodcard-stripe2-zip"
                                                   name="zip"
                                                   data-tid="elements_foodcard-stripes.form.postal_code_placeholder"
                                                   class="input empty" type="text" placeholder="12345" required=""
                                                   autocomplete="postal-code">
                                            <label for="foodcard-stripe2-zip" data-tid="elements_foodcard-stripes.form.postal_code_label">Code postal</label>
                                            <div class="baseline"></div>
                                        </div>
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
                                <button type="submit" data-tid="elements_foodcard-stripes.form.pay_button" class="payment-button">Payer</button>
                                <div class="error" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                        <path class="base" fill="#000"
                                              d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                                        <path class="glyph" fill="#FFF"
                                              d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                                    </svg>
                                    <span class="message"></span></div>
                                <div class="success">
                                    <div class="icon">
                                        <svg width="84px" height="84px" viewBox="0 0 84 84" version="1.1"
                                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <circle class="border" cx="42" cy="42" r="40" stroke-linecap="round"
                                                    stroke-width="4" stroke="#000" fill="none"></circle>
                                            <path class="checkmark" stroke-linecap="round" stroke-linejoin="round"
                                                  d="M23.375 42.5488281 36.8840688 56.0578969 64.891932 28.0500338"
                                                  stroke-width="4" stroke="#000" fill="none"></path>
                                        </svg>
                                    </div>
                                    <h3 class="title" data-tid="elements_foodcard-stripes.success.title">Payment successful</h3>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    @endif
@endsection

@section('js')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/plugins/card.js') }}"></script>

    <script>
        $(".card").card();

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
            var form = document.getElementById('payment-form');
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
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            createToken();
        });

        $('.payment-amount').on('change', function() {
            let label = $('label[for="' + $(this).attr('id') + '"]').attr('data-value');
           $('.payment-button').text("Payer " + label);
        });

    </script>
@endsection
