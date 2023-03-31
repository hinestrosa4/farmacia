@section('title', 'Datos personales')
@extends('layouts.base')

<style>
    #cuerpo {
        margin: 1em;
    }

    #paginacion {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #cuerpo {
        margin: 2em;
    }

    table {
        text-align: center;
    }
</style>

@section('menu')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mr-6">
                    <div class="col-sm-6">
                        <h1>Datos personales</h1>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listaProductos') }}">Home</a></li>
                            <li class="breadcrumb-item active">Datos personales</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md3 ml-3">
                                <div class="card card-success card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img src=
                                            @foreach ($usuario as $user)
                                            @if ($user->sexo == 'hombre') {{ asset('img/avatarUser.png') }}
                                            @elseif ($user->sexo == 'mujer')
                                            {{ asset('img/avatarUserMujer.png') }} @endif
                                            @endforeach
                                                alt="" class="profile-user-img img-fluid img-circle">
                                        </div>
                                        <h3 class="profile-username text-center text-success">{{ Auth::user()->nombre }}
                                        </h3>
                                        <p class="text-muted text-center">{{ Auth::user()->apellidos }}</p>
                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b style="color:#0B7300">Edad</b><a href=""
                                                    class="float-right">{{ $user->edad }}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b style="color:#0B7300">DNI</b><a href=""
                                                    class="float-right">{{ $user->dni }}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b style="color:#0B7300">Tipo</b><span
                                                    class="float-right badge badge-primary mt-1">
                                                    @if ($user->tipo == 1)
                                                        Administrador
                                                    @elseif ($user->tipo == 2)
                                                        Farmaceutico
                                                    @elseif ($user->tipo == 3)
                                                        Técnico
                                                    @elseif ($user->tipo == 4)
                                                        Auxiliar
                                                    @endif
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card card-success">
                                    <div class="car-header">
                                        <h3 class="card title text-center">Sobre mi</h3>
                                    </div>
                                    <div class="card-body">
                                        <strong style="color:#0B7300">
                                            <i class="bi bi-telephone-fill mr-1"></i>Teléfono
                                        </strong>
                                        <p class="text-muted">{{ $user->telefono }}</p>
                                        <strong style="color:#0B7300">
                                            <i class="bi bi-geo-alt-fill"></i> Dirección
                                        </strong>
                                        <p class="text-muted">{{ $user->direccion }}</p>
                                        <strong style="color:#0B7300">
                                            <i class="fas fa-at mr-1"></i>Correo electrónico
                                        </strong>
                                        <p class="text-muted">{{ $user->email }}</p>
                                        <strong style="color:#0B7300">
                                            <i class="bi bi-gender-ambiguous"></i> Sexo
                                        </strong>
                                        <p class="text-muted">{{ $user->sexo }}</p>
                                        <button class="btn btn-block bg-gradient-danger">Editar</button>

                                    </div>
                                    <div class="card-footer">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Editar datos personales</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="" class="row g-3 needs-validation">
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Teléfono</label>
                                                <input type="text" name="fechaRealizacion" class="form-control"
                                                    id="telefono" value="" placeholder="Teléfono">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom01" class="form-label">Dirección</label>
                                                <input type="text" name="direccion" class="form-control" id="direccion"
                                                    value="" placeholder="Direccion">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustomUsername" class="form-label">Correo
                                                    electrónico</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    <input type="text" name="correo" class="form-control" id="correo"
                                                        value="" placeholder="Correo"
                                                        aria-describedby="inputGroupPrepend">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="validationCustom04" class="form-label">Tipo</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sexo"
                                                        id="hombre" value="0">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Hombre
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="sexo"
                                                        id="mujer" value="1">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Mujer
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <button class="btn btn-success" type="submit">Enviar Formulario</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

@endsection
