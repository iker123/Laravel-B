@extends('adminlte::page')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fas fa-users"></i> Administrar Usuarios</h1>
            </div>
            <div class="col-sm-6 text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoUsuarioModal">
                    Nuevo Usuario
                </button>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-end align-items-center"
            style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <input type="text" id="searchInput" class="form-control form-control-sm mr-2" style="width: 200px;"
                placeholder="Buscar...">
        </div>
        <div class="card-body">
            @include('usuarios.modal_nuevo')
            <div class="table-responsive">
                <table id="usuariosTable" class="table table-bordered table-hover" style="background-color: white;">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->roles->pluck('name')->implode(', ') }}</td>
                                <td><span class="{{ $usuario->estado == 1 ? 'badge bg-success' : 'badge bg-danger' }}">
                                        {{ $usuario->estado == 1 ? 'ACTIVO' : 'INACTIVO' }}
                                    </span></td>
                                <td>
                                    @include('usuarios.modal_editar')
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#editarUsuarioModal{{ $usuario->id }}">
                                        <i class="fas fa-edit"></i>
                                        Editar
                                    </button>
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                            <i class="fas fa-trash"></i>
                                            Eliminar</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    {{ $usuarios->links('pagination::bootstrap-4') }}
                </div>
            </div>
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

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Mensaje de éxito
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        // Mensajes de error
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            });
        @endif
    </script>

    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                let value = $(this).val().toLowerCase();
                $('#tableBody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@stop
