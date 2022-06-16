@include('admin.includes.alerts')
@csrf

<div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $plan->name ?? old('name') }}"
        placeholder="Nome">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <textarea name="description" ols="30" rows="5" class="form-control">{{ $category->description ?? old('description') }}</textarea>
</div>
<button type="submit" class="btn btn-primary">Enviar</button>
