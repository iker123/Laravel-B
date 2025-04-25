<div class="modal fade" id="editarUsuarioModal{{ $usuario->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editarUsuarioModalLabel{{ $usuario->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarUsuarioModalLabel{{ $usuario->id }}">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body row">
                    <input type="hidden" name="id" id="editUserId">
                    <div class="col-sm-12">
                        <strong>Nombre Completo: <span class="text-danger">*</span></strong>
                        <input type="text" class="form-control" name="name" value="{{ $usuario->name }}"
                            id="editUserName" required>
                    </div>
                    <div class="col-sm-8">
                        <strong>Email: <span class="text-danger">*</span></strong>
                        <input type="email" class="form-control" name="email" value="{{ $usuario->email }}"
                            id="editUserEmail" required>
                    </div>
                    <div class="col-sm-4">
                        <strong>Contraseña:</strong>
                        <input type="password" class="form-control" name="password" id="editUserPassword">
                    </div>
                    <div class="col-sm-8">
                        <strong>Seleccione Rol: <span class="text-danger">*</span></strong>
                        <select class="form-control" name="rol_id" id="editUserRole" required>
                            <option value="">Seleccione un Rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}" @if ($usuario->roles->pluck('id')->contains($rol->id)) selected @endif>
                                    {{ $rol->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <strong>Estado:</strong>
                        <select name="estado" class="form-control">
                            <option value="1" {{ $usuario->estado == 1 ? 'selected' : '' }}>ACTIVO</option>
                            <option value="0" {{ $usuario->estado == 0 ? 'selected' : '' }}>INACTIVO</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
