@csrf

<div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name ?? old('name') }}" placeholder="Nome">
</div>
<div class="mb-3">
    <label for="description" class="form-label">Descrição</label>
    <input type="text" class="form-control" id="description" name="description" value="{{ $permission->description ?? old('description') }}" placeholder="Descrição">
</div>
<button type="submit" class="btn btn-primary">Enviar</button>
