<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as EloquentModel;

class GuestbookEntry extends EloquentModel
{
    protected $connection = 'mongodb';
    protected $collection = 'guestbook_entries'; // Nombre de la colección en MongoDB
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'message',
        'created_at'
    ];

    /**
     * Relación con el evento correspondiente.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
