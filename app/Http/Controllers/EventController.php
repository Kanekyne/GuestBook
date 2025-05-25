<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
   /**
     * Mostrar todos los eventos activos.
     */
    public function index()
    {
        $events = Event::where('status', 'active')->get();
        return response()->json($events);
    }

       /**
     * Crear un nuevo evento (solo admin).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'honoree_name' => 'required|string',
            'type' => 'required|string',
            'created_at' => 'required|date',
            'closed_at' => 'nullable|date',
            'admin_id' => 'required'
        ]);

        $event = Event::create($request->all());

        return response()->json(['message' => 'Evento creado con éxito', 'event' => $event]);
    }

     /**
     * Editar un evento.
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $event->update($request->all());

        return response()->json(['message' => 'Evento actualizado', 'event' => $event]);
    }
    
        /**
     * Desactivar un evento.
     */
    public function deactivate($id)
    {
        $event = Event::findOrFail($id);
        $event->update(['status' => 'inactive']);

        return response()->json(['message' => 'Evento desactivado']);
    }

}