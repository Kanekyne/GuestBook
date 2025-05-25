@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Gestión de Usuarios</h1>

    <table class="table table-bordered mt-4">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->_id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <form action="{{ url('/admin/users/' . $user->_id . '/change-role') }}" method="POST" class="d-inline">
                        @csrf
                        <select name="role" class="form-select d-inline" style="width: auto;">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Usuario</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">Actualizar Rol</button>
                    </form>

                    <form action="{{ url('/admin/users/' . $user->_id) }}" method="POST" class="d-inline">
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
