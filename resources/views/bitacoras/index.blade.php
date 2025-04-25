@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-fw fa-book"></i>Administrar Bitácoras</h1>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        @include('bitacoras.filtros')
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                            <th>Tabla</th>
                            <th>Ralizado por</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bitacoras as $key => $bitacora)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $bitacora->fecha }}</td>
                                <td>{{ $bitacora->accion }}</td>
                                <td>{{ $bitacora->tabla }}</td>
                                <td>{{ $bitacora->realizado_por }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    {{ $bitacoras->links('pagination::bootstrap-4') }}
                </div>
            </div> --}}
        </div>
    </div>
@stop

@section('css')
    <style>
        .pagination {
            font-size: 0.85rem;
        }

        .table-light th {
            background-color: #f8f9fa !important;
            color: #333 !important;
        }

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
@stop
