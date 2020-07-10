
<div class="col-2 col-md-3 col-lg-3">
    <div class="user-card">
        <div class="user-card-img-container">
            <img src="{{asset('images/restaurant/resto-1.jpg')}}" alt="Restaurant name" class="img-fluid">
        </div>
        <div class="user-card-description-container">
            <H5>{{$store->name}}</H5>
            <div class="row no-gutters user-card-description">
                <div class="col-4">
                    Adresse :
                </div>
                <div class="col-8">
                    {{$store->address}}
                </div>
            </div>

            <div class="row no-gutters user-card-description">
                <div class="col-4">
                    Téléphone :
                </div>
                <div class="col-8">
                    01 01 01 01 01
                </div>
            </div>

            <div class="row no-gutters user-card-description">
                <div class="col-4">
                    Email :
                </div>
                <div class="col-8">
                    email@email.com
                </div>
            </div>

            <div class="row no-gutters user-card-description">
                <div class="col-12 text-right contact-name">
                    Name Lastname
                </div>
            </div>
        </div>

        <span class="type-shop-container">{{$store->storeType()->first()->type}}</span>
    </div>
</div>
