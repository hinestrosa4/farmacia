@section('title', 'Configuración')
@extends('layouts.base')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 mr-6">
                    <div class="col-sm-6">
                        <h1>Configuración</h1>
                    </div>
                    <div class="col-sm-4">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('listaProductos') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Configuración</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="container mt-2">
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="{{ route('listarImagenes') }}" class="btn btn-primary btn-block">Imágenes</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="#" class="btn btn-primary btn-block">Opción 2</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="#" class="btn btn-primary btn-block">Opción 3</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="#" class="btn btn-primary btn-block">Opción 4</a>
                </div>
            </div>
        </section>
    </div>
@endsection
