<div class="modal fade" id="permisosRolModal{{$rol->id}}" tabindex="-1" role="dialog"
    aria-labelledby="editarRolModalLabel{{$rol->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarRolModalLabel{{$rol->id}}">Editar Permisos del Rol:
                    <strong>{{ $rol->name }}</strong>

                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('roles.update', $rol->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="rol_id" value="{{ $rol->id }}">
                    <div class="col-sm-12">
                        @php
                        $gruposPermisos = [];
                        foreach ($permisos as $permiso) {
                        $categoria = explode(' ', $permiso->name)[0];
                        if (!isset($gruposPermisos[$categoria])) {
                        $gruposPermisos[$categoria] = [];
                        }


                        $gruposPermisos[$categoria][] = $permiso;
                        }
                        @endphp

                        @foreach ($gruposPermisos as $grupo => $permisos)
                        <!-- Verificamos si el grupo es 'Bitácora' y si el rol es 'superadmin' -->
                        @if ($grupo === 'Bitacora' && Auth::user()->name!= 'Super Admin')
                            @continue <!-- Si el grupo es 'Bitácora' y no es superAdmin, salta esta iteración -->
                        @else

                            <div class="mb-3">
                                <strong style="font-size: 1em; display: block;">Permisos de {{ $grupo }}</strong>
                                <div class="d-inline-block">
                                    @foreach ($permisos as $permiso)
                                    <div class="form-check d-inline">
                                        <input class="form-check-input" type="checkbox" name="permisos[]"
                                            value="{{ $permiso->id }}"
                                            @if ($rol->permissions->contains($permiso)) checked @endif>
                                        <label class="form-check-label"
                                            for="permiso_{{ $permiso->id }}">{{ $permiso->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @endforeach

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Permisos</button>
                </div>
            </form>
        </div>
    </div>
</div>