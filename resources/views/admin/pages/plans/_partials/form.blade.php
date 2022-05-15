<div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $plan->name ?? old('name') }}" placeholder="Nome">
</div>
<div class="mb-3">
    <label for="price" class="form-label">Preço</label>
    <input type="text" class="form-control" id="price" name="price" value="{{ $plan->price ?? old('price') }}" placeholder="Preço">
</div>
<div class="mb-3">
    <label for="description" class="form-label">Descrição</label>
    <input type="text" class="form-control" id="description" name="description" value="{{ $plan->description ?? old('description') }}" placeholder="Descrição">
</div>
<button type="submit" class="btn btn-primary">Enviar</button>