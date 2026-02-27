@extends('layouts.diseno')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-5">

        <div class="card border-success shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Modificar Comida</h4>
            </div>

            <div class="card-body">
                

                {{-- Error --}}

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>mensaje de comida:</strong> No se pudo actualizar:<br>
                        <ul class="mb-0 mt-1">
                            @if($errors->has('nombre_comida')) <li>El nombre es obligatorio.</li> @endif
                            @if($errors->has('costo')) <li>El precio debe ser un número entero (pesos) y no negativo.</li> @endif
                            @if($errors->has('detalle_comida')) <li>La descripción es necesaria.</li> @endif
                        </ul>
                    </div>
                @endif
                

                <form action="{{ route('comidas.update', $comida->id_comida) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        {{-- nombre de comida --}}
                        <label class="form-label">Nombre de la Comida:</label>
                        <input type="text" name="nombre_comida" 
                               class="form-control" 
                               value="{{ old('nombre_comida', $comida->nombre_comida) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Costo:</label>
                    
                        <input type="number" step="1" min="0" name="costo" 
                               class="form-control" 
                               value="{{ old('costo', (int)$comida->costo) }}">
                        <small class="text-muted">Solo se permiten cantidades en pesos no centavos.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Categoría:</label>
                        <select name="id_tipo_comida" class="form-select">
                            @foreach($tipocomidas as $opcion)
                                @php
                                    $id_db = $opcion->id_tipo_comida;
                                    $id_actual = $comida->id_tipo_comida;
                                @endphp
                                <option value="{{ $id_db }}" {{ $id_db == $id_actual ? 'selected' : '' }}>
                                    {{ $opcion->nombre_categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción:</label>
                        <textarea name="detalle_comida" class="form-control" rows="3">{{ old('detalle_comida', $comida->detalle_comida) }}</textarea>
                    </div>

                    <div class="pt-3">
                        
                        <button type="submit" class="btn btn-success w-100 mb-2">Guardar cambios en el menú</button>
                        <a href="{{ route('comidas.index') }}" class="btn btn-outline-secondary w-100">Cancelar y regresar</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection