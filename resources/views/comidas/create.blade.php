@extends('layouts.diseno')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h4 class="mb-0">Registrar Nueva Comida</h4>
            </div>
            <div class="card-body">

                {{-- Error --}}

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>mensaje:</strong> Revisa estos detalles:
                        <ul class="mb-0 mt-2">
                            @if($errors->has('nombre_comida')) <li>El nombre es obligatorio.</li> @endif
                            @if($errors->has('costo')) <li>El precio debe ser un número entero y no negativo.</li> @endif
                            @if($errors->has('detalle_comida')) <li>Falta la descripción.</li> @endif
                            @if($errors->has('id_tipo_comida')) <li>Elige una categoría.</li> @endif
                        </ul>
                    </div>
                @endif


                <form action="{{ route('comidas.store') }}" method="POST">
                    @csrf
                    

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Nombre de la Comida:</label>
                        <input type="text" name="nombre_comida" class="form-control" value="{{ old('nombre_comida') }}" placeholder="Ej. Tacos">
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Costo:</label>
                        <input type="number" step="1" min="0" name="costo" class="form-control" 
                               value="{{ old('costo') }}" placeholder="Ej. 150">
                        <small class="text-muted">No se aceptan centavos, solo cantidades en pesos.</small>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Categoría:</label>
                        <select name="id_tipo_comida" class="form-select">
                            <option value="">-- Seleccionar --</option>
                            @foreach($tipocomidas as $tipo)
                                <option value="{{ $tipo->id_tipo_comida }}" {{ old('id_tipo_comida') == $tipo->id_tipo_comida ? 'selected' : '' }}>
                                    {{ $tipo->nombre_categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-4">
                        <label class="form-label">Descripción:</label>
                        <textarea name="detalle_comida" class="form-control" rows="3">{{ old('detalle_comida') }}</textarea>
                    </div>

                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Guardar Comida</button>
                        <a href="{{ route('comidas.index') }}" class="btn btn-light border">Cancelar</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection