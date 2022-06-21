@csrf

<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome:" value="{{ $user->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>E-mail:</label>
    <input type="email" name="email" class="form-control" placeholder="E-mail:"
        value="{{ $user->email ?? old('email') }}">
</div>
<div class="form-group">
    <label>Senha:</label>
    <input type="password" name="password" class="form-control" placeholder="Senha:">
</div>
<div class="row">
    <div class="col-sm-4">
        <label for="FrmStatus">Status: *</label>
        <div class="form-group">
            <label class="radio-inline"><input type="radio" name="active" value="Y" checked="checked"> Ativo</label>
            <label class="radio-inline"><input type="radio" name="active" value="N"> Inativo</label>
        </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
