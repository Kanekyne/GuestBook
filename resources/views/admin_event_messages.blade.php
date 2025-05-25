@extends('layouts.app')

@section('content')
    <div class="container bg-light text-dark p-4">
        <h1 class="text-center">Mensajes del Evento: {{ $event->name }}</h1>
        <p class="text-center"><strong>Homenaje a:</strong> {{ $event->honoree_name }}</p>

        <h3 class="mt-4">Mensajes Recientes</h3>
        <div class="mt-3">
            @foreach ($messages as $message)
                <div class="card p-3 mb-2">
                    <p><strong>{{ $message->name }}</strong> ({{ $message->email }})</p>
                    <p>{{ $message->message }}</p>
                    <small class="text-muted">{{ $message->created_at }}</small>

                    <form action="{{ url('/admin/events/' . $event->_id . '/messages/' . $message->_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar Mensaje</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
