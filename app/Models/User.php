<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use MongoDB\Laravel\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{

    protected $connection = 'mongodb';
    protected $collection = 'users'; // Definimos la colección en MongoDB
    protected $fillable = [
        'name',
        'email',
        'password',
        'role' // 'admin' o 'user'
    ];

    /**
     * Verifica si el usuario es administrador.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    #sirve?

}