{{--<form action="{{route('adminMiddleBillingPortalStore')}}" method="post" id="formPayment">--}}
{{--    @csrf--}}
    <input id="card-holder-name" type="text">

    <!-- Stripe Elements Placeholder -->
    <div id="card-element"></div>

<select name="subscribe" id="plan">
    @foreach($subscribes as $key => $subscribe)
        <option value="{{$key}}">{{$subscribe}}</option>
    @endforeach
</select>

    <button id="card-button" data-secret="{{ $intent->client_secret }}">
        Update Payment Method
    </button>
{{--    <div class="row" style="margin-top: 80px; padding-bottom: 30px">--}}
{{--        <div class="col-2"></div>--}}
{{--        <div class="col-md-8" style="padding: 0 55px">--}}
{{--            <div class="text-center" style="padding: 11px;background-color: #E5F1FF;">--}}
{{--                <span style="font-weight: 500; font-size: 17px">PAIEMENT DE</span><br>--}}
{{--                <span style="font-size: 22px; font-weight: 800; color: #338BF8">14.99 €</span>--}}
{{--            </div>--}}
{{--            <h2 style="color: #338BF8; font-weight: 800; font-size: 15px; margin-bottom: 28px; margin-top: 20px">INFORMATIONS DE FACTURATION</h2>--}}
{{--            <div class="row" style="margin-top: 20px;">--}}
{{--                <div class="form-group col-md-6 group">--}}
{{--                    <label for="nomprenom" style="font-weight: 500">Nom et prénom</label>--}}
{{--                    <input style="font-size: 16px;" type="text" name="cardholder-name" id="nomprenom" class="field onlyBorderBottom form-control" required/>--}}
{{--                </div>--}}
{{--                <div class="form-group col-md-6 group">--}}
{{--                    <label for="email" style="font-weight: 500">Adresse email</label>--}}
{{--                    <input style="font-size: 16px;" type="email" name="cardholder-email" id="email" class="field onlyBorderBottom form-control" required/>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="row" style="margin-top: 20px;">--}}
{{--                <div class="form-group col-md-6 group">--}}
{{--                    <label for="adresse" style="font-weight: 500">Adresse</label>--}}
{{--                    <input style="font-size: 16px;" type="text" name="cardholder-address" id="adresse" class="field onlyBorderBottom form-control"required/>--}}
{{--                </div>--}}
{{--                <div class="form-group col-md-6 group">--}}
{{--                    <label for="ville" style="font-weight: 500">Ville</label>--}}
{{--                    <input style="font-size: 16px;" type="text" name="cardholder-city" id="ville" class="field onlyBorderBottom form-control" required/>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <h2 style="color: #338BF8; font-weight: 800; font-size: 15px; margin-bottom: 28px; margin-top: 30px">CARTE BANCAIRE</h2>--}}
{{--            <div class="cardCustom">--}}
{{--                <div class="group" style="border: none; border-bottom:1px solid #caccd0; border-radius: 0 ">--}}
{{--                    <label>--}}
{{--                        <div id="card-element" class="field"></div>--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <input type="hidden" id="stripeToken" name="stripeToken">--}}
{{--    <input type="submit" id="submitButton" >--}}
{{--    <div class="outcome">--}}
{{--        <div class="error"></div>--}}
{{--    </div>--}}
{{--</form>--}}
