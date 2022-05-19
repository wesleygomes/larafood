@csrf
<div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $detail->name ?? old('name') }}" placeholder="Nome">
</div>
<button type="submit" class="btn btn-primary">Enviar</button>