@extends('layouts.app')

@section('content')
    <div class="container bg-light text-dark p-4">

        <h1 class="text-center">Eventos Activos</h1>

        @if (Auth::check() && Auth::user()->isAdmin())
            <a href="{{ url('/events/create') }}" class="btn btn-success mb-3">Crear Nuevo Evento</a>
        @endif


        @if (isset($message))
            <p class="text-center text-warning">{{ $message }}</p>
        @elseif($events->isEmpty())
            <p class="text-center text-warning">No hay eventos disponibles en este momento.</p>
        @else
            <h1 class="text-center">Bienvenido, {{ Auth::user()->name }}! 🎉</h1>
            <p class="text-center">Aquí están los eventos activos en los que puedes participar.</p>

            use App \Models\User

            User::create([
            'name' => 'Admin',
            'email' => '2@2.2',
            'password' => bcrypt('22222222'),
            'role' => 'admin'
            ]);
            App\Models\User



            <div class="row">
                @foreach ($events as $event)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ $event->name }}</h3>
                                <p class="card-text"><strong>Homenaje a:</strong> {{ $event->honoree_name }}</p>
                                <p class="card-text"><strong>Tipo:</strong> {{ $event->type }}</p>
                                <p class="card-text"><strong>Fecha de cierre:</strong> {{ $event->closed_at }}</p>
                                <a href="{{ url('/events/' . $event->_id . '/guestbook') }}" class="btn btn-primary">Ver
                                    libro de visitas</a>
                                <a href="{{ url('/events/' . $event->_id . '/guestbook') }}" class="btn btn-primary">Ver
                                    libro de visitas</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
