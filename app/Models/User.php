<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;
use MongoDB\Laravel\Eloquent\Model as EloquentModel;


class User extends EloquentModel implements AuthenticatableContract
{

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

    /**
     * Implementación de los métodos requeridos por AuthenticatableContract
     */
    public function getAuthIdentifierName()
    {
        return 'email';
    }

    public function getAuthIdentifier()
    {
        return $this->email;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token ?? null;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getAuthPasswordName()
    {
        return 'password';
    }


    #sirve?, sip, sirvió

}
