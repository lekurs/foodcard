<div class="mout-middle-admin-usercards">
    <span class="circle circle-username" id="username">{{substr($userByStore->lastname, 0, 1) .substr($userByStore->name, 0, 1)}}</span>
    <p class="mout--fat" id="name">{{$userByStore->name . ' ' . $userByStore->lastname}}</p>
    <p class="mout--fat" id="role">{{$userByStore->userFonction()->first()->fonction}}</p>
    <p class="mout--light" id="email">{{$userByStore->email}}</p>
    <p class="mout--light" id="phone">@if(!empty($userByStore->phone)) {{$userByStore->phone}} @else Pas de téléphone enregistré @endif</p>
    <div class="usercards-circle-container">
        <a href="#" class="middle-edit-user" data-user="{{$userByStore->id}}">
            <span class="circle edit-user-icon" ><i class="fal fa-magic"></i></span>
        </a>
        <a href="#" data-user="{{$userByStore->id}}">
            <span class="circle trash-user-icon"><i class="fal fa-trash"></i></span>
        </a>
    </div>
</div>
