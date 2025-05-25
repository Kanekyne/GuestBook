@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Gestión de Eventos</h1>

    <a href="{{ url('/admin/events/create') }}" class="btn btn-success mb-3">Crear Nuevo Evento</a>

    <table class="table table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Homenaje a</th>
                <th>Tipo</th>
                <th>Fecha de Cierre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>{{ $event->_id }}</td>
                <td>{{ $event->name }}</td>
                <td>{{ $event->honoree_name }}</td>
                <td>{{ $event->type }}</td>
                <td>{{ $event->closed_at }}</td>
                <td>
                    <a href="{{ url('/admin/events/' . $event->_id . '/edit') }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ url('/admin/events/' . $event->_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
