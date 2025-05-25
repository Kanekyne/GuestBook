@extends('layouts.app')

@section('content')
    <div class="container bg-dark text-white p-4">

        <h1 class="text-center">Editar Evento</h1>

        <form action="{{ url('/admin/events/' . $event->_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nombre del Evento:</label>
                <input type="text" name="name" class="form-control" value="{{ $event->name }}" required>
            </div>
            <div class="mb-3">
                <label>Homenaje a:</label>
                <input type="text" name="honoree_name" class="form-control" value="{{ $event->honoree_name }}" required>
            </div>
            <div class="mb-3">
                <label>Tipo de Evento:</label>
                <input type="text" name="type" class="form-control" value="{{ $event->type }}" required>
            </div>
            <div class="mb-3">
                <label>Estado del Evento:</label>
                <select name="status" class="form-select">
                    <option value="active" {{ $event->status == 'active' ? 'selected' : '' }}>Activo</option>
                    <option value="inactive" {{ $event->status == 'inactive' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Fecha de cierre:</label>
                <input type="date" name="closed_at" class="form-control" value="{{ $event->closed_at }}" required>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar Evento</button>
        </form>
    </div>
@endsection
