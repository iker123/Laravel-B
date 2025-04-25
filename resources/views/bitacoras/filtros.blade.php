<form action="{{ route('bitacoras.index') }}" method="POST">
    @csrf
    <div class="card2">
        <div class="row">
            <div class="col-md-3">
                <strong>Fecha Inicio:</strong>
                <input type="date" class="form-control" name="fecha_inicio"
                value="{{ old('fecha_inicio', request('fecha_inicio')) }}">
            </div>
            <div class="col-md-3">
                <strong>Fecha Fin:</strong>
                <input type="date" class="form-control" name="fecha_fin"
                value="{{ old('fecha_fin', request('fecha_fin')) }}">
            </div>
            <div class="col-md-4">
                <strong>Realizado por:</strong>
                <input type="text" class="form-control" name="realizado_por"
                    value="{{ old('realizado_por', request('realizado_por')) }}">
            </div>
            <div class="col-md-2 text-end">
                <br>
                <button type="submit" class="btn btn-primary form-control">
                    <i class="fa fa-search"></i> BUSCAR

                </button>
            </div>
        </div>
    </div>
</form>

<style>
    .card2 {
        background-color: #c6c6c6;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }
</style>
