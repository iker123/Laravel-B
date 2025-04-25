<div class="modal fade" id="nuevoUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="nuevoUsuarioModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoUsuarioModalLabel">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf
                <div class="modal-body row">
                    <div class="col-sm-12">
                        <strong>Nombre Completo: <span class="text-danger">*</span></strong>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="col-sm-8">
                        <strong>Email: <span class="text-danger">*</span></strong>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="col-sm-4">
                        <strong>Contraseña: <span class="text-danger">*</span></strong>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="col-sm-12">
                        <strong>Seleccione Rol: <span class="text-danger">*</span></strong>
                        <select class="form-control" name="rol_id" required>
                            <option value="" selected disabled>Seleccione...</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
