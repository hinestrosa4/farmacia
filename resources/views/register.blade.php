@section('title', 'Registro')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <title>@yield('title')</title>
</head>
<style>
    #form {
        margin: 1em;
    }
</style>


<form id="form" class="row g-3 needs-validation" method="POST" action="{{ route('formRegister') }}">
@csrf
<h1>Nuevo usuario</h1>
@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

<div class="col-md-3">
    <label for="validationCustom01" class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre') }}"
        placeholder="Introduzca su nombre">
    {!! $errors->first('nombre', '<span style=color:red>:message</span>') !!}
</div>

<div class="col-md-3">
    <label for="validationCustom02" class="form-label">Apellidos</label>
    <input type="text" name="apellidos" class="form-control" id="apellidos" value="{{ old('apellidos') }}"
        placeholder="Introduzca sus apellidos">
    {!! $errors->first('apellidos', '<span style=color:red>:message</span>') !!}
</div>

<div class="col-md-3">
    <label for="validationCustom02" class="form-label">Edad</label>
    <input type="text" name="edad" class="form-control" id="edad" value="{{ old('edad') }}"
        placeholder="Introduzca su edad">
    {!! $errors->first('edad', '<span style=color:red>:message</span>') !!}
</div>

<div class="col-md-3">
    <label for="validationCustom01" class="form-label">DNI</label>
    <input type="text" name="dni" class="form-control" id="dni" value="{{ old('dni') }}"
        placeholder="Introduzca su DNI">
    {!! $errors->first('dni', '<span style=color:red>:message</span>') !!}
</div>

<div class="col-md-3">
    <label for="validationCustomUsername" class="form-label">Correo electrónico</label>
    <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend">@</span>
        <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}"
            placeholder="Correo electrónico" aria-describedby="inputGroupPrepend">
    </div>
    {!! $errors->first('email', '<span style=color:red>:message</span>') !!}
</div>

<div class="col-md-3">
    <label for="validationCustom01" class="form-label">Contraseña</label>
    <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}"
        placeholder="Introduzca su clave">
    {!! $errors->first('password', '<span style=color:red>:message</span>') !!}
</div>

<div class="col-md-3">
    <label for="validationCustom01" class="form-label">Tipo</label>
    <select name="tipo" class="form-select">
        <option value="2" {{ old('tipo') == 'farmaceutico' ? 'selected' : '' }}>Farmacéutico</option>
        <option value="3" {{ old('tipo') == 'tecnico' ? 'selected' : '' }}>Técnico</option>
        <option value="4" {{ old('tipo') == 'auxiliar' ? 'selected' : '' }}>Auxiliar</option>
        <option value="1" {{ old('tipo') == 'administrador' ? 'selected' : '' }}>Administrador</option>
    </select>
    {!! $errors->first('tipo', '<span style=color:red>:message</span>') !!}
</div>

<div class="col-12">
    <button class="btn btn-success" type="submit">Registrarme</button>
    <a href="{{ route('login') }}" class="btn btn-primary" id="cancel-btn">Atras</a>
</div>
</form>
