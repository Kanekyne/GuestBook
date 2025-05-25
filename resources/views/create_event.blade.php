@extends('layouts.app')

@section('content')
<div class="container bg-dark text-white p-4">

    <h1 class="text-center">Crear Nuevo Evento</h1>

    <form action="{{ url('/admin/events') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre del Evento:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Homenaje a:</label>
            <input type="text" name="honoree_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipo de Evento:</label>
            <input type="text" name="type" class="form-control" required>
        </div>
<div class="mb-3">
    <label>Estado del Evento:</label>
    <select name="status" class="form-select">
        <option value="active">Activo</option>
        <option value="inactive">Inactivo</option>
    </select>
</div>


        <div class="mb-3">
            <label>Fecha de cierre:</label>
            <input type="date" name="closed_at" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Crear Evento</button>
    </form>
</div>
@endsection
