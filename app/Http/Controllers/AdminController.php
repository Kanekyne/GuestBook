<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\GuestbookEntry;

class AdminController extends Controller
{
    public function listUsers()
    {
        $users = User::all();
        return view('admin_users', compact('users'));
    }

    public function changeUserRole(Request $request, User $user)
    {
        $user->role = $request->input('role');
        $user->save();
        return redirect()->back()->with('success', 'Rol actualizado.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Usuario eliminado.');
    }

    public function listEvents()
    {
        $events = Event::all();
        return view('admin_events', compact('events'));
    }

    public function showCreateEventForm()
    {
        return view('create_event');
    }

    public function editEvent(Event $event)
    {
        return view('edit_event', compact('event'));
    }

    public function createEvent(Request $request)
    {
        Event::create($request->all());
        return redirect()->back()->with('success', 'Evento creado.');
    }
    public function storeEvent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'honoree_name' => 'required|string|max:255',
            'type' => 'required|string',
            'closed_at' => 'required|date',
        ]);

        Event::create([
            'name' => $request->name,
            'honoree_name' => $request->honoree_name,
            'type' => $request->type,
            'closed_at' => $request->closed_at,
            'status' => 'active',
        ]);

        # return redirect('/admin/events')->with('success', 'Evento creado correctamente.');
        return redirect()->route('admin.events')->with('success', 'Evento creado correctamente.');
    }




    public function updateEvent(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'honoree_name' => 'required|string|max:255',
            'type' => 'required|string',
            'closed_at' => 'required|date',
        ]);

        $event->update($request->all());

        return redirect('/admin/events')->with('success', 'Evento actualizado correctamente.');
    }

    public function showEventMessages(Event $event)
    {
        $messages = GuestbookEntry::where('event_id', $event->_id)->orderBy('created_at', 'desc')->get();
        return view('admin_event_messages', compact('event', 'messages'));
    }


    // public function deleteEventMessage($eventId, $messageId)
    // {
    //     $event = Event::findOrFail($eventId);
    //     $event->messages()->where('_id', $messageId)->delete();
    //     return redirect()->back()->with('success', 'Mensaje eliminado.');
    // }

    public function deleteMessage($eventId, $messageId)
    {
        $message = GuestbookEntry::where('_id', $messageId)->where('event_id', $eventId)->firstOrFail();
        $message->delete();

        return redirect()->back()->with('success', 'Mensaje eliminado correctamente.');
    }

    public function deleteEvent(Event $event)
    {
        $event->delete();
        return redirect('/admin/events')->with('success', 'Evento eliminado correctamente.');
    }
}
