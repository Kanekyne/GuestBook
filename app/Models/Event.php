<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model as EloquentModel;

class Event extends EloquentModel
{
     protected $connection = 'mongodb';
    protected $collection = 'events'; // Nombre de la colección en MongoDB
    protected $fillable = [
        'name',
        'created_at',
        'closed_at',
        'honoree_name',
        'type',
        'visit_count',
        'status',
        'admin_id'
        ];

    /**
     * Relación con las entradas del Guestbook.
     */
    public function guestbookEntries()
    {
        return $this->hasMany(GuestbookEntry::class);
    }
}
