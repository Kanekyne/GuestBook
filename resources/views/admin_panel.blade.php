@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Panel de Administración</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Administrar Usuarios</h3>
                    <p>Gestiona los usuarios registrados, cambia roles y elimina cuentas si es necesario.</p>
                    <a href="{{ url('/admin/users') }}" class="btn btn-danger">Ver Usuarios</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h3>Administrar Eventos</h3>
                    <p>Edita eventos existentes, crea nuevos y elimina mensajes inapropiados.</p>
                    <a href="{{ url('/admin/events') }}" class="btn btn-warning">Ver Eventos</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
