<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuestbookEntry;
use App\Models\Event;

class GuestbookEntryController extends Controller
{
        public function index($eventId)
    {
        $entries = GuestbookEntry::where('event_id', $eventId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($entries);
    }

        /**
     * Agregar una entrada al guestbook de un evento.
     */
    public function store(Request $request, $eventId)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Verificar si el evento está activo
        $event = Event::findOrFail($eventId);
        if ($event->status !== 'active' || now() > $event->closed_at) {
            return response()->json(['error' => 'Este evento no acepta más mensajes.'], 403);
        }

        // Crear la entrada del guestbook
        $entry = GuestbookEntry::create([
            'event_id' => $eventId,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => now(),
        ]);

        return response()->json(['message' => 'Mensaje agregado con éxito.', 'entry' => $entry]);
    }
    
        /**
     * Eliminar una entrada del guestbook (solo admin).
     */
    public function destroy($entryId)
    {
        $entry = GuestbookEntry::findOrFail($entryId);
        $entry->delete();

        return response()->json(['message' => 'Mensaje eliminado con éxito.']);
    }



}
