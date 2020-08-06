<form action="{{route('adminMiddleUserCreation')}}" method="post">
    @csrf
    @include('flashes.errors')
    <input type="hidden" name="userid" id="userid" value="@isset($user){{$user->id}}@endisset">
    <div class="input-groupe floating-label">
        <input type="text" name="username" id="username" class="form-control floating-input" placeholder=" " value="@isset($user) {{$user->name}}@endisset">
        <label for="username" class="float">Nom *</label>
        <span class="highlight"></span>
    </div>

    <div class="input-groupe floating-label">
        <input type="text" name="lastname" id="lastname" class="form-control floating-input" placeholder=" " value="@isset($user) {{$user->lastname}}@endisset">
        <label for="lastname" class="float">Prénom *</label>
        <span class="highlight"></span>
    </div>

    <div class="input-groupe floating-label">
        <select name="user-fonction" id="user-fonction">
            <option value="">Selectionnez la fonction</option>
            @foreach($userFonctions as $userFonction)
                <option value="{{$userFonction->id}}">{{$userFonction->fonction}}</option>
            @endforeach
        </select>
    </div>

    <div class="input-groupe floating-label">
        <input type="email" name="email" id="email" class="form-control floating-input" placeholder=" " value="@isset($user) {{$user->email}}@endisset">
        <label for="email" class="float">Email *</label>
        <span class="highlight"></span>
    </div>

    <div class="input-groupe floating-label">
        <input type="text" name="user-phone" id="user-phone" class="form-control floating-input" placeholder=" " value="@isset($user) {{$user->phone}}@endisset">
        <label for="user-phone" class="float">Téléphone</label>
        <span class="highlight"></span>
    </div>

    <div class="input-groupe floating-label">
        <input type="password" name="password" id="password" class="form-control floating-input" placeholder=" " autocomplete="new-password">
        <label for="password" class="float">Mot de passe *</label>
        <span class="highlight"></span>
    </div>

    <div class="input-groupe floating-label">
        <input type="password" name="repeat-password" id="repeat-password" class="form-control floating-input" placeholder=" " autocomplete="new-password">
        <label for="repeat-password" class="float">Répéter mot de passe *</label>
        <span class="highlight"></span>
    </div>
    <div class="input-groupe button-container text-left">
        <button type="submit" class="btn mout-btn-add-middle active">@isset($user)Modifier @else Ajouter @endisset</button>
    </div>
</form>
