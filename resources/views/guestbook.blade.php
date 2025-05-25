@extends('layouts.app')

@section('content')
<div class="container bg-light text-dark p-4">

    <h1 class="text-center">Libro de Visitas: {{ $event->name }}</h1>
    <p class="text-center"><strong>Homenaje a:</strong> {{ $event->honoree_name }}</p>

    <div class="card p-3 mt-3">
        <h3>Dejar un mensaje</h3>
        <form action="{{ url('/events/' . $event->_id . '/guestbook') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nombre:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Correo:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Mensaje:</label>
                <textarea name="message" class="form-control" required></textarea>
            </div>
           <button type="submit" class="btn btn-primary">Enviar Mensaje</button>

        </form>
    </div>

    <h3 class="mt-4">Mensajes Recientes</h3>
    <div class="mt-3">
        @foreach($entries as $entry)
        <div class="card p-3 mb-2">
            <p><strong>{{ $entry->name }}</strong> ({{ $entry->email }})</p>
            <p>{{ $entry->message }}</p>
            <small class="text-muted">{{ $entry->created_at }}</small>
        </div>
        @endforeach
    </div>
</div>
@endsection
