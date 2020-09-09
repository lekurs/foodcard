@extends('layouts.middle-layout')
@section('title', ' Bienvenue')

@section('header')
    <div class="mout-admin-middle-header-container" id="store"
         style="background-image:url('@if( isset($store) && !empty($medias['illustration']) ){{ asset('storage/store/' . \Illuminate\Support\Str::slug($store->name) . '/background/' . $medias['illustration']->path)}}@else {{ asset('public/foodcard-admin-middle-header.jpg') }}@endif') ">
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
        <div class="mout-admin-middle-stripe-container">
            {{--            <div class="mout-admin-middle-stripe-content">--}}
            {{--                <p class="edit-user" data-user=""><span class="mout-middle-edit-user-icon"><i class="fal fa-user"></i></span></p>--}}
            {{--                <p class="mout--fat">{{auth()->user()->name . ' ' . auth()->user()->lastname}}</p>--}}
            {{--                <a href="#" class="btn mout-btn-edit-middle mout-btn-form-middle">modifier</a>--}}
            {{--            </div>--}}
            <div class="mout-admin-middle-container">
                <form id="payment-form" action="{{ route('adminMiddleBillingPortalSubscribe') }}" method="post">
                    @csrf
                    <input type="hidden" name="stripeToken" id="stripeToken">

                    <div class="card-wrapper"></div>

                    <div class="cell foodcard-stripe foodcard-stripe2" id="foodcard-stripe-2">
                        <form>
                            <div data-locale-reversible>
                                <div class="row">
                                    <div class="field">
                                        <input id="foodcard-stripe2-address"
                                               data-tid="elements_foodcard-stripes.form.address_placeholder" class="input empty"
                                               type="text" placeholder="185 Berry St" required=""
                                               autocomplete="address-line1">
                                        <label for="foodcard-stripe2-address" data-tid="elements_foodcard-stripes.form.address_label">Address</label>
                                        <div class="baseline"></div>
                                    </div>
                                </div>
                                <div class="row" data-locale-reversible>
                                    <div class="field half-width">
                                        <input id="foodcard-stripe2-city" data-tid="elements_foodcard-stripes.form.city_placeholder"
                                               class="input empty" type="text" placeholder="San Francisco" required=""
                                               autocomplete="address-level2">
                                        <label for="foodcard-stripe2-city"
                                               data-tid="elements_foodcard-stripes.form.city_label">City</label>
                                        <div class="baseline"></div>
                                    </div>
                                    <div class="field quarter-width">
                                        <input id="foodcard-stripe2-state" data-tid="elements_foodcard-stripes.form.state_placeholder"
                                               class="input empty" type="text" placeholder="CA" required=""
                                               autocomplete="address-level1">
                                        <label for="foodcard-stripe2-state"
                                               data-tid="elements_foodcard-stripes.form.state_label">State</label>
                                        <div class="baseline"></div>
                                    </div>
                                    <div class="field quarter-width">
                                        <input id="foodcard-stripe2-zip"
                                               data-tid="elements_foodcard-stripes.form.postal_code_placeholder"
                                               class="input empty" type="text" placeholder="94107" required=""
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
                        </form>
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
                            <p class="message"><span data-tid="elements_foodcard-stripes.success.message">Thanks for trying Stripe Elements. No money was charged, but we generated a token: </span><span
                                    class="token">tok_189gMN2eZvKYlo2CwTBv9KKh</span></p>
                            <a class="reset" href="#">
                                <svg width="32px" height="32px" viewBox="0 0 32 32" version="1.1"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path fill="#000000"
                                          d="M15,7.05492878 C10.5000495,7.55237307 7,11.3674463 7,16 C7,20.9705627 11.0294373,25 16,25 C20.9705627,25 25,20.9705627 25,16 C25,15.3627484 24.4834055,14.8461538 23.8461538,14.8461538 C23.2089022,14.8461538 22.6923077,15.3627484 22.6923077,16 C22.6923077,19.6960595 19.6960595,22.6923077 16,22.6923077 C12.3039405,22.6923077 9.30769231,19.6960595 9.30769231,16 C9.30769231,12.3039405 12.3039405,9.30769231 16,9.30769231 L16,12.0841673 C16,12.1800431 16.0275652,12.2738974 16.0794108,12.354546 C16.2287368,12.5868311 16.5380938,12.6540826 16.7703788,12.5047565 L22.3457501,8.92058924 L22.3457501,8.92058924 C22.4060014,8.88185624 22.4572275,8.83063012 22.4959605,8.7703788 C22.6452866,8.53809377 22.5780351,8.22873685 22.3457501,8.07941076 L22.3457501,8.07941076 L16.7703788,4.49524351 C16.6897301,4.44339794 16.5958758,4.41583275 16.5,4.41583275 C16.2238576,4.41583275 16,4.63969037 16,4.91583275 L16,7 L15,7 L15,7.05492878 Z M16,32 C7.163444,32 0,24.836556 0,16 C0,7.163444 7.163444,0 16,0 C24.836556,0 32,7.163444 32,16 C32,24.836556 24.836556,32 16,32 Z"></path>
                                </svg>
                            </a>
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

        const stripeResponseHandler = function (status, response) {
            // Grab the form:
            const form = document.getElementById('payment-form');

            if (response.error) { // Problem!
                // Show the errors on the form:
            } else { // Token was created!
                // Get the token ID:
                const token = response.id;

                // Insert the token ID into the form so it gets submitted to the server
                const form = document.getElementById('payment-form');
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        };

        // Create a token when the form is submitted
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Stripe.card.createToken(form, stripeResponseHandler);
        });

    </script>
@endsection
