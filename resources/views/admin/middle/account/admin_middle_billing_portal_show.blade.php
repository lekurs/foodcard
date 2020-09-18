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

        <div class="mout-admin-middle-header-nav-ariane" id="menu">
            <i class="fal fa-concierge-bell"></i>
            <p>ma carte</p>
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
        <div class="mout-admin-middle-stripe-container">
            {{--            <div class="mout-admin-middle-stripe-content">--}}
            {{--                <p class="edit-user" data-user=""><span class="mout-middle-edit-user-icon"><i class="fal fa-user"></i></span></p>--}}
            {{--                <p class="mout--fat">{{auth()->user()->name . ' ' . auth()->user()->lastname}}</p>--}}
            {{--                <a href="#" class="btn mout-btn-edit-middle mout-btn-form-middle">modifier</a>--}}
            {{--            </div>--}}
            <div class="mout-admin-middle-container">
                <form id="payment-form" action="{{ route('adminMiddleBillingPortalSubscribe') }}" method="post">
                    @csrf
{{--                    <input type="hidden" name="stripeToken" id="stripeToken">--}}

                    <div class="card-wrapper"></div>

                    <div class="cell foodcard-stripe foodcard-stripe2" id="foodcard-stripe-2">
                        <div class="row" data-locale-reversible>
                            <div class="field half-width">
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
                            <div class="field quarter-width">
                                <input id="foodcard-stripe2-lastname"
                                       name="lastname"
                                       data-tid="elements_foodcard-stripes.form.lastname_placeholder"
                                       class="input empty"
                                       type="text"
                                       placeholder="CA"
                                       required=""
                                       autocomplete="lastname-level1">
                                <label for="foodcard-stripe2-lastname"
                                       data-tid="elements_foodcard-stripes.form.lastname_label">Prénom</label>
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
                                           data-tid="elements_foodcard-stripes.form.city_label">City</label>
                                    <div class="baseline"></div>
                                </div>
                                <div class="field quarter-width">
                                    <input id="foodcard-stripe2-state"
                                           name="country"
                                           data-tid="elements_foodcard-stripes.form.state_placeholder"
                                           class="input empty"
                                           type="text"
                                           placeholder="CA"
                                           required=""
                                           autocomplete="address-level1">
                                    <label for="foodcard-stripe2-state"
                                           data-tid="elements_foodcard-stripes.form.state_label">State</label>
                                    <div class="baseline"></div>
                                </div>
                                <div class="field quarter-width">
                                    <input id="foodcard-stripe2-zip"
                                           name="zip"
                                           data-tid="elements_foodcard-stripes.form.postal_code_placeholder"
                                           class="input empty" type="text" placeholder="12345" required=""
                                           autocomplete="postal-code">
                                    <label for="foodcard-stripe2-zip" data-tid="elements_foodcard-stripes.form.postal_code_label">ZIP</label>
                                    <div class="baseline"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="field">
                                <div id="foodcard-stripe2-card-number" class="input empty"></div>
                                <label for="foodcard-stripe2-card-number"
                                       data-tid="elements_foodcard-stripes.form.card_number_label">Card number</label>
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
                            <div class="field half-width">
                                <div id="foodcard-stripe2-card-cvc" class="input empty"></div>
                                <label for="foodcard-stripe2-card-cvc"
                                       data-tid="elements_foodcard-stripes.form.card_cvc_label">CVC</label>
                                <div class="baseline"></div>
                            </div>
                        </div>
                        <button type="submit" data-tid="elements_foodcard-stripes.form.pay_button">Pay $25</button>
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
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{--    <script src="{{ asset('js/middle-admin/users-manager.js') }}"></script>--}}
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/plugins/jquery.card.js') }}"></script>

    <script>
        $('#payment-form').card({
            container: '.card-wrapper', // *required*
            formSelector: {
              numberInput: "input#number",
            },
            placeholders: {
                number: '**** **** **** ****',
                name: 'Arya Stark',
                expiry: '**/****',
                cvc: '***'
            }
        });


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
            // Insert the token ID into the form so it gets submitted to the server
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
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server
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

    </script>
@endsection
