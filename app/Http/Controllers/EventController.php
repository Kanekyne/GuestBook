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

    public function showEvents()
    {
        $events = Event::where('status', 'active')->get();

        return view('events', [
            'events' => $events,
            'message' => $events->isEmpty() ? 'No hay eventos activos en este momento.' : null
        ]);
    }

    // public function showEvents()
    // {
    //     $today = now(); // Obtiene la fecha actual

    //     $events = Event::where('status', 'active')
    //         ->where('closed_at', '>=', $today) // Filtra eventos cuya fecha de cierre aún no ha pasado
    //         ->get();

    //     return view('events', [
    //         'events' => $events,
    //         'message' => $events->isEmpty() ? 'No hay eventos activos en este momento.' : null
    //     ]);
    // }

    // public function showEvents()
    // {
    //     $today = now(); // Obtiene la fecha actual

    //     $events = Event::where('status', 'active')  // Solo eventos activos
    //         ->where('closed_at', '>=', $today)      // Solo eventos cuya fecha de cierre aún no ha pasado
    //         ->get();

    //         dd($today);

    //     return view('events', [
    //         'events' => $events,
    //         'message' => $events->isEmpty() ? 'No hay eventos activos en este momento.' : null
    //     ]);
    // }


    // public function showEvents()
    // {
    //     $today = now()->startOfDay(); // Define la fecha de hoy desde el inicio del día

    //     $events = Event::where('status', 'active')  // Solo eventos activos
    //         ->whereDate('closed_at', '>=', $today) // Solo eventos cuya fecha de cierre aún no ha pasado
    //         ->get();

    //     return view('events', [
    //         'events' => $events,
    //         'message' => $events->isEmpty() ? 'No hay eventos activos en este momento.' : null
    //     ]);
    // }




    // public function showEvents()
    // {
    //     $events = Event::where('status', 'active')->get();
    //     // Verifica que eventos existen antes de pasarlos a la vista
    //     if ($events->isEmpty()) {
    //         return view('events')->with('message', 'No hay eventos activos en este momento.');
    //     }
    //     #return view('events', compact('events'));

    //     $events = Event::where('status', 'active')->get();
    //     return view('events', compact('events'));
    // }

    /**
     * Crear un nuevo evento (solo admin).
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'honoree_name' => 'required|string',
    //         'type' => 'required|string',
    //         'created_at' => 'required|date',
    //         'closed_at' => 'nullable|date',
    //         'admin_id' => 'required'
    //     ]);

    //     $event = Event::create($request->all());

    //     return response()->json(['message' => 'Evento creado con éxito', 'event' => $event]);
    // }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'honoree_name' => 'required|string|max:255',
            'type' => 'required|string',
            'closed_at' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        Event::create([
            'name' => $request->name,
            'honoree_name' => $request->honoree_name,
            'type' => $request->type,
            'closed_at' => $request->closed_at,
            'status' => $request->status,
            // 'admin_id' => auth()->user()->_id, // Guarda el ID del admin que creó el evento
        ]);

        return redirect()->route('admin.events')->with('success', 'Evento creado correctamente.');
    }


    /**
     * Editar un evento.
     */
    // public function update(Request $request, $id)
    // {
    //     $event = Event::findOrFail($id);

    //     $event->update($request->all());

    //     return response()->json(['message' => 'Evento actualizado', 'event' => $event]);
    // }

    public function updateEvent(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'honoree_name' => 'required|string|max:255',
            'type' => 'required|string',
            'closed_at' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $event->update([
            'name' => $request->name,
            'honoree_name' => $request->honoree_name,
            'type' => $request->type,
            'closed_at' => $request->closed_at,
            'status' => $request->status,
        ]);

        return redirect('/admin/events')->with('success', 'Evento actualizado correctamente.');
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
