<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Farmacia</title>
</head>

<body>
    <form method="POST" action="{{ route('formRegister') }}">
        @csrf
        <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
            <div class="card card0 border-0">
                <div class="row d-flex">
                    <div class="col-lg-6">
                        <div class="card1 pb-5">
                            <div class="row justify-content-center">
                                <img src="{{ asset('img/bannerlogin.png') }}" alt=""
                                    style="margin-top:30px; width: 400px;">
                            </div>
                            <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                                <img src="{{ asset('img/asideRegister.png') }}" style="height: 500px; width:500px; margin-top:50px" class="image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-center">
                            <h1 class="mt-5" style="color:rgb(8, 98, 8)">Registro</h1>
                        </div>
                        <div class="card2 card border-0 px-4 py-5">
                           
                            <form id="form" class="row g-3 needs-validation" method="POST"
                                action="{{ route('formRegister') }}">
                                @csrf
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

                                <div class="">
                                    <label for="validationCustom01" class="form-label">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" id="nombre"
                                        value="{{ old('nombre') }}" placeholder="Introduzca su nombre">
                                    {!! $errors->first('nombre', '<span style=color:red>:message</span>') !!}
                                </div>

                                <div class="">
                                    <label for="validationCustom02" class="form-label">Apellidos</label>
                                    <input type="text" name="apellidos" class="form-control" id="apellidos"
                                        value="{{ old('apellidos') }}" placeholder="Introduzca sus apellidos">
                                    {!! $errors->first('apellidos', '<span style=color:red>:message</span>') !!}
                                </div>

                                <div class="">
                                    <label for="validationCustom02" class="form-label">Fecha nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" class="form-control"
                                        id="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
                                        placeholder="Introduzca su fecha de nacimiento">
                                    {!! $errors->first('fecha_nacimiento', '<span style=color:red>:message</span>') !!}
                                </div>

                                <div class="">
                                    <label for="validationCustom01" class="form-label">DNI</label>
                                    <input type="text" name="dni" class="form-control" id="dni"
                                        value="{{ old('dni') }}" placeholder="Introduzca su DNI">
                                    {!! $errors->first('dni', '<span style=color:red>:message</span>') !!}
                                </div>

                                <div class="">
                                    <label for="validationCustomUsername" class="form-label">Correo electrónico</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" name="email" class="form-control" id="email"
                                            value="{{ old('email') }}" placeholder="Correo electrónico"
                                            aria-describedby="inputGroupPrepend">
                                    </div>
                                    {!! $errors->first('email', '<span style=color:red>:message</span>') !!}
                                </div>

                                <div class="">
                                    <label for="validationCustom01" class="form-label">Contraseña</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        value="{{ old('password') }}" placeholder="Introduzca su clave">
                                    {!! $errors->first('password', '<span style=color:red>:message</span>') !!}
                                </div>

                                <div class="">
                                    <label for="validationCustom01" class="form-label">Tipo</label>
                                    <select name="tipo" class="form-select">
                                        <option value="2" {{ old('tipo') == 'farmaceutico' ? 'selected' : '' }}>
                                            Farmacéutico</option>
                                        <option value="3" {{ old('tipo') == 'tecnico' ? 'selected' : '' }}>
                                            Técnico</option>
                                        <option value="4" {{ old('tipo') == 'auxiliar' ? 'selected' : '' }}>
                                            Auxiliar</option>
                                        <option value="1" {{ old('tipo') == 'administrador' ? 'selected' : '' }}>
                                            Administrador</option>
                                    </select>
                                    {!! $errors->first('tipo', '<span style=color:red>:message</span>') !!}
                                </div>
                            </form>
                            <br>
                            <div class="row mb-3 px-3">
                                <button class="btn btn-blue text-center" type="submit">Registrarme</button>
                            </div>
                            <div class="row mb-4 px-3">
                                <small class="font-weight-bold">Ya tienes una cuenta? <a href="{{ route('login') }}"
                                        class="text-danger ">Logueate</a></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-blue py-4">
                    <div class="row px-3">
                        <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2023. Rafael Hinestrosa.</small>
                        <div class="social-contact ml-4 ml-sm-auto">
                            <span class="fa fa-facebook mr-4 text-sm"></span>
                            <span class="fa fa-google-plus mr-4 text-sm"></span>
                            <span class="fa fa-linkedin mr-4 text-sm"></span>
                            <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
