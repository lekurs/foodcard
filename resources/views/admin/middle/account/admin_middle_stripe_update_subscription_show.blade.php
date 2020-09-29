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
            <i class="fal fa-smile"></i>
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
        <div class="mout-admin-strip-subscription">
            <h4 class="mout--regular">Mon abonnement</h4>
            @foreach($subscriptions as $subscription)
                <div class="mout-middle-admin-subscription-container">
                    <p class="mout--regular">{{ $subscription->plan->nickname }}</p>
                    <p>Début : {{ Carbon\Carbon::createFromTimestamp($subscription->current_period_start)->translatedFormat('d/m/Y') }}</p>
                    <p>Fin : {{ Carbon\Carbon::createFromTimestamp($subscription->current_period_end)->translatedFormat('d/m/Y') }}</p>
                    <p>Prix : {{ number_format($subscription->plan->amount_decimal / 100, 2, ',', '') }} €</p>
                    <a href="{{ url()->previous() }}" class="btn mout-btn-add">Annuler</a>
                </div>
            @endforeach
        </div>

        <div class="mout-admin-middle-stripe-payment">
        <h4 class="mout--regular">Choisir ma formule</h4>
        <div class="mout-admin-middle-stripe-container">
            <div class="mout-admin-middle-container">
                <form id="payment-form" action="{{ route('stripeEditSubscriptionStore') }}" method="post">
                    @csrf
                    <div class="row amount-container">
                        @foreach($subscribes as $key => $subcribe)
                            <input type="radio" name="amount" id="amount-{{ $subcribe }}" value="{{ $key }}" class="payment-amount"">
                            <label for="amount-{{ $subcribe }}" data-value="{{ $subcribe }}" id="{{ $key }}">{{ $subcribe }}</label>
                        @endforeach
                    </div>
                    <button type="submit" data-tid="elements_foodcard-stripes.form.pay_button" class="payment-button">Payer</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
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
                // cardExpiry.mount('#foodcard-stripe-add-payment-card-expiry');

                const cardCvc = elements.create('cardCvc', {
                    style: elementStyles,
                    classes: elementClasses,
                });
                cardCvc.mount('#foodcard-stripe2-card-cvc');
                // cardCvc.mount('#foodcard-stripe-add-payment-card-cvc');

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

                // stripe.createPaymentMethod({
                //         type: 'card',
                //         card: cardElement,
                //         // billing_details: {
                //         //     name: 'Jenny Rosen',
                //         // },
                //     })
                //     .then(function(result) {
                //         // Handle result.error or result.paymentMethod
                //     });

            </script>
@endsection
