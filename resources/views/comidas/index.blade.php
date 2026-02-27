@extends('layouts.diseno')

@section('contenido')
<div class="row">
    <div class="col-md-12">

        {{-- Error --}}
        
        @if(session('exito'))
            @php $mensajeRecibido = session('exito'); @endphp
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Hecho! :</strong> {{ $mensajeRecibido }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 style="display: inline-block;">Menú</h3>
                <a href="{{ route('comidas.create') }}" class="btn btn-warning float-end">Agregar Nueva Comida</a>
            </div>

            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Costo</th>
                            <th>Tipo de Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    
                    <tbody>

                        @forelse($comidas as $comida)
                            @php $id_actual = $comida->id_comida; @endphp
                            <tr>
                                <td>{{ $id_actual }}</td>
                                {{-- nombre de comida --}}
                                <td>{{ $comida->nombre_comida }}</td>
                                <td>$ {{ number_format($comida->costo, 2) }}</td>
                                <td>
                                    @if($comida->tipoComida)
                                        {{ $comida->tipoComida->nombre_categoria }}
                                    @else
                                        <span class="text-muted">Sin tipo</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('comidas.edit', $id_actual) }}" class="btn btn-info btn-sm">Editar</a>
                                    
                                    <form action="{{ route('comidas.destroy', $id_actual) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres borrarlo?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <p class="text-muted">No hay comidas registradas todavía.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection