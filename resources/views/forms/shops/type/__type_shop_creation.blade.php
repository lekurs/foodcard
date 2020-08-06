<form action="{{route('storesTypesShowStore')}}" method="post">
    @csrf
    @include('flashes.errors')

    <div class="floating-label">
        <input type="hidden" value="" name="id" id="modal-type-id">
        <input id="store_type" type="text" class="floating-input form-control @error('role') is-invalid @enderror" name="store_type" placeholder=" " required autocomplete="role">
        <label for="store_type" class="float form-control-label required">Type de commerce</label>
    </div>

    <button type="submit" class="btn mout-btn-add">Ajouter</button>
</form>
