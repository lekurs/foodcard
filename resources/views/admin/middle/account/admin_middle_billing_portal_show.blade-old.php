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
{{--    <script src="{{ asset('js/middle-admin/users-manager.js') }}"></script>--}}
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('js/plugins/jquery.card.js') }}"></script>

    <script>

        $('#form-stripe').card({
            // a selector or DOM element for the container
            // where you want the card to appear
            container: '.card-wrapper', // *required*

            // all of the other options from above
        });

        // new Card({
        //     form: document.querySelector('form'),
        //     container: '.card-wrapper'
        // });
        // new Card({
        //     form: 'form',
        //     container: '.card',
        //     formSelectors: {
        //         numberInput: 'input[name=number]',
        //         expiryInput: 'input[name=expiry]',
        //         cvcInput: 'input[name=cvv]',
        //         nameInput: 'input[name=name]'
        //     },
        //     width: 390, // optional — default 350px
        //     formatting: true
        // });

    </script>

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

    const stripe = Stripe('{{ env('STRIPE_KEY') }}');

    const elements = stripe.elements({locale: 'fr'});
    const cardElement = elements.create('card', {style: style});

    cardElement.mount('#card-element');

    
    // cardElement.on('change', showCardError);
    //
    // function showCardError(event) {
    //     let displayError = document.getElementById('card-errors');
    //     if (event.error) {
    //         displayError.textContent = event.error.message;
    //     } else {
    //         displayError.textContent = '';
    //     }
    // }
    //
    // var form = document.getElementById('payment-form');
    // form.addEventListener('submit', function (event) {
    //     event.preventDefault();
    //
    //     stripe.createToken(cardElement).then(function (result) {
    //         if(result.error) {
    //             var errorElement = document.getElementById('card-errors');
    //             errorElement.textContent = result.error.message;
    //         } else {
    //             stripeTokenHandler(result.token);
    //         }
    //     });
    // });
    //
    // function stripeTokenHandler(token) {
    //     // Insert the token ID into the form so it gets submitted to the server
    //     document.getElementById('stripeToken').value = token.id;
    //     // Submit the form
    //     form.submit();
    // }

</script>
@endsection
