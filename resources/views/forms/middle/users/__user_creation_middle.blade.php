<form action="">
    @csrf
    @include('flashes.errors')
    <div class="input-groupe floating-label">
        <input type="text" name="username" id="username" class="form-control floating-input" placeholder=" ">
        <label for="username" class="float">Nom *</label>
        <span class="highlight"></span>
    </div>

    <div class="input-groupe floating-label">
        <input type="text" name="lastname" id="lastname" class="form-control floating-input" placeholder=" ">
        <label for="lastname" class="float">Prénom *</label>
        <span class="highlight"></span>
    </div>

    <div class="input-groupe floating-label">
        <input type="text" name="user-fonction" id="user-fonction" class="form-control floating-input" placeholder=" ">
        <label for="user-fonction" class="float">Fonction *</label>
        <span class="highlight"></span>
    </div>

    <div class="input-groupe floating-label">
        <input type="email" name="email" id="email" class="form-control floating-input" placeholder=" ">
        <label for="email" class="float">Email *</label>
        <span class="highlight"></span>
    </div>

    <div class="input-groupe floating-label">
        <input type="text" name="user-phone" id="user-phone" class="form-control floating-input" placeholder=" ">
        <label for="user-phone" class="float">Téléphone</label>
        <span class="highlight"></span>
    </div>

    <div class="input-groupe floating-label">
        <input type="password" name="password" id="password" class="form-control floating-input" placeholder=" ">
        <label for="password" class="float">Mot de passe *</label>
        <span class="highlight"></span>
    </div>

    <div class="input-groupe floating-label">
        <input type="password" name="repeat-password" id="repeat-password" class="form-control floating-input" placeholder=" ">
        <label for="repeat-password" class="float">Répéter mot de passe *</label>
        <span class="highlight"></span>
    </div>
    <div class="input-groupe button-container text-left">
        <button type="submit" class="btn mout-btn-add-middle active">Ajouter</button>
    </div>
</form>
