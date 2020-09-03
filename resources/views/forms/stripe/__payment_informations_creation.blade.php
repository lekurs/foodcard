{{--<form id="payment-form" action="{{ route('adminMiddleBillingPortalSubscribe') }}" method="post">--}}
{{--    @csrf--}}
    <input type="hidden" name="stripeToken" id="stripeToken">
{{--    <input type="text" name="username" id="username" value="{{ auth()->user()->username }}">--}}

{{--    <div class="demo-container">--}}
        <div class="card-wrapper"></div>

        <div class="form-container active">
            <form action="" id="form-stripe">
                <input placeholder="Card number" type="tel" name="number">
                <input placeholder="Full name" type="text" name="name">
                <input placeholder="MM/YY" type="tel" name="expiry">
                <input placeholder="CVC" type="number" name="cvc">
            </form>
        </div>

        <div id="card-element" class="MyCardElement">
            <!-- Elements will create input elements here -->
        </div>

        <!-- We'll put the error messages in this element -->
        <div id="card-errors" role="alert"></div>
        <button type="submit">Subscribe</button>
{{--    </div>--}}

{{--</form>--}}
