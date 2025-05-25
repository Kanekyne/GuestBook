<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

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

    public function createEvent(Request $request)
    {
        Event::create($request->all());
        return redirect()->back()->with('success', 'Evento creado.');
    }

    public function updateEvent(Request $request, Event $event)
    {
        $event->update($request->all());
        return redirect()->back()->with('success', 'Evento actualizado.');
    }

    public function deleteEventMessage($eventId, $messageId)
    {
        $event = Event::findOrFail($eventId);
        $event->messages()->where('_id', $messageId)->delete();
        return redirect()->back()->with('success', 'Mensaje eliminado.');
    }
}
