<form id="payment-form" action="{{route('adminMiddleBillingPortalSubscribe')}}" method="post">
    @csrf
    <input type="hidden" name="stripeToken" id="stripeToken">
    <input type="text" name="username" id="username" value="{{auth()->user()->username}}">
    <div id="card-element" class="MyCardElement">
        <!-- Elements will create input elements here -->
    </div>

    <!-- We'll put the error messages in this element -->
    <div id="card-errors" role="alert"></div>
    <button type="submit">Subscribe</button>
</form>
