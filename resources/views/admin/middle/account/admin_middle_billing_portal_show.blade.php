@extends('layouts.middle-layout')
@section('title', ' Bienvenue')

@section('header')
    <div class="mout-admin-middle-header-container" id="store">
        @if(isset($store) && !is_null($store->medias()->first()->logo))
            {{--        <img src="{{asset('images/restaurant/' . $store->name . '/' . $store->medias()->first()->logo)}}" alt="{{$store->name}}" class="img-fluid">--}}

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
        <a href="{{route('adminMiddleStoreShow')}}" class="btn mout-admin-middle-nav-buttons btn-store"><i class="fal fa-home"></i></a>
        <a href="{{route('adminMiddleMenuShow')}}" class="btn mout-admin-middle-nav-buttons btn-menu"><i class="fal fa-concierge-bell"></i></a>
    </div>
@endsection

@section('body')
    <div class="mout-admin-middle-content-panel">
        <div class="mout-admin-middle-stripe-container">
{{--            <div class="mout-admin-middle-stripe-content">--}}
{{--                <p class="edit-user" data-user=""><span class="mout-middle-edit-user-icon"><i class="fal fa-user"></i></span></p>--}}
{{--                <p class="mout--fat">{{auth()->user()->name . ' ' . auth()->user()->lastname}}</p>--}}
{{--                <a href="#" class="btn mout-btn-edit-middle mout-btn-form-middle">modifier</a>--}}
{{--            </div>--}}
            <div class="mout-admin-middle-container">
                @include('forms.stripe.__payment_informations_creation')
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('js/middle-admin/users-manager.js')}}"></script>

    <script src="https://js.stripe.com/v3/"></script>

    <script>
        var style = {
            base: {
                color: "#32325d",
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#aab7c4"
                }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            }
        };

        const stripe = Stripe('{{env('STRIPE_KEY')}}');

        const elements = stripe.elements({locale: 'fr'});
        const cardElement = elements.create('card', {style: style});

        cardElement.mount('#card-element');

        cardElement.on('change', showCardError);

        function showCardError(event) {
            let displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        }

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            stripe.createToken(cardElement).then(function (result) {
                if(result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            document.getElementById('stripeToken').value = token.id;
            // Submit the form
            form.submit();
        }

    </script>

{{--    <script>--}}
{{--        var stripe = Stripe('{{env('STRIPE_KEY')}}');--}}
{{--        var elements = stripe.elements();--}}
{{--        var card = elements.create('card', {--}}
{{--            style: {--}}
{{--                base: {--}}
{{--                    iconColor: '#666EE8',--}}
{{--                    color: '#31325F',--}}
{{--                    lineHeight: '40px',--}}
{{--                    fontWeight: 300,--}}
{{--                    fontFamily: 'Helvetica Neue',--}}
{{--                    fontSize: '15px',--}}

{{--                    '::placeholder': {--}}
{{--                        color: '#CFD7E0',--}}
{{--                    },--}}
{{--                },--}}
{{--            }--}}
{{--        });--}}
{{--        card.mount('#card-element');--}}

{{--        function setOutcome(result) {--}}
{{--            var errorElement = document.querySelector('.error');--}}
{{--            errorElement.classList.remove('visible');--}}

{{--            if (result.token) {--}}
{{--                $('#stripeToken').val(result.token.id);--}}
{{--                $('#formPayment').submit();--}}
{{--            } else if (result.error) {--}}
{{--                errorElement.textContent = result.error.message;--}}
{{--                errorElement.classList.add('visible');--}}
{{--            }--}}
{{--        }--}}

{{--        card.on('change', function(event) {--}}
{{--            setOutcome(event);--}}
{{--        });--}}

{{--        document.getElementById('formPayment').addEventListener('submit', function(e) {--}}
{{--            e.preventDefault();--}}

{{--            var form = document.getElementById('formPayment');--}}
{{--            stripe.createPaymentMethod('card', card, {--}}
{{--                billing_details: {name: form.querySelector('input[name=cardholder-name]').value}--}}
{{--            }).then(function(result) {--}}
{{--                if (result.error) {--}}
{{--                    var errorElement = document.querySelector('.error');--}}
{{--                    errorElement.textContent = result.error.message;--}}
{{--                    errorElement.classList.add('visible');--}}
{{--                } else {--}}
{{--                    $('#buttonPayment').hide();--}}
{{--                    $('#spanWaitPayement').show();--}}
{{--                    // Otherwise send paymentMethod.id to your server (see Step 2)--}}
{{--                    fetch('{{route('adminMiddleBillingPortalStore')}}', {--}}
{{--                        method: 'POST',--}}
{{--                        headers: {--}}
{{--                            'Content-Type': 'application/json',--}}
{{--                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),--}}
{{--                        },--}}
{{--                        body: JSON.stringify({ payment_method_id: result.paymentMethod.id })--}}
{{--                    }).then(function(result) {--}}
{{--                        result.json().then(function(json) {--}}
{{--                            handleServerResponse(json);--}}
{{--                        })--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}

{{--        function handleServerResponse(response) {--}}
{{--            if (response.error) {--}}
{{--                $('#buttonPayment').show();--}}
{{--                $('#spanWaitPayement').hide();--}}
{{--                var errorElement = document.querySelector('.error');--}}
{{--                errorElement.textContent = result.error.message;--}}
{{--                errorElement.classList.add('visible');--}}
{{--            } else if (response.requires_action) {--}}
{{--                // Use Stripe.js to handle required card action--}}
{{--                stripe.handleCardAction(--}}
{{--                    response.payment_intent_client_secret--}}
{{--                ).then(function(result) {--}}
{{--                    if (result.error) {--}}
{{--                        $('#buttonPayment').show();--}}
{{--                        $('#spanWaitPayement').hide();--}}
{{--                        var errorElement = document.querySelector('.error');--}}
{{--                        errorElement.textContent = result.error.message;--}}
{{--                        errorElement.classList.add('visible');--}}
{{--                    } else {--}}
{{--                        // The card action has been handled--}}
{{--                        // The PaymentIntent can be confirmed again on the server--}}
{{--                        fetch('/api/paiement', {--}}
{{--                            method: 'POST',--}}
{{--                            headers: {--}}
{{--                                'Content-Type': 'application/json',--}}
{{--                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),--}}
{{--                            },--}}
{{--                            body: JSON.stringify({ payment_intent_id: result.paymentIntent.id })--}}
{{--                        }).then(function(confirmResult) {--}}
{{--                            return confirmResult.json();--}}
{{--                        }).then(handleServerResponse);--}}
{{--                    }--}}
{{--                });--}}
{{--            } else {--}}
{{--                window.location.replace('/paiement-ok');--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}
@endsection
