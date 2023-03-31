@section('title', 'Listado de Productos')
@extends('layouts.base')
@section('header')
@endsection
@section('footer')
@endsection
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
    {{-- <div id="cuerpo">
        <h1>Lista de Productos</h1>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row">
            @foreach ($productos as $producto)
                <div class="col-md-2">
                    <div class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }} {{ $producto->concentracion }}</h5>
                            <img src="{{ asset('img/' . $producto->nombre . '.png') }}" class="card-img-top"
                                alt="{{ $producto->nombre }}">
                            <p class="card-text">{{ $producto->adicional }}</p>
                            <p class="card-text">{{ $producto->precio }} €</p>
                            <a href="{{ route('confirmacionBorrarproducto', $producto) }}" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}


    {{-- 
        <div id="paginacion">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item {{ $productos->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $productos->previousPageUrl() }}">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $productos->lastPage(); $i++)
                        <li class="page-item {{ $productos->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $productos->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $productos->currentPage() == $productos->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $productos->nextPageUrl() }}">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div> --}}
    <!-- Main Sidebar Container -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Blank Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Titleee</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    Start creating your amazing application!
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
