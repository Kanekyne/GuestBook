<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestbookEntryController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     #return view('dashboard');
//     redirect('/events');
// })->middleware(['auth', 'verified'])->name('dashboard');




Route::get('/dashboard', function () {
    if (Auth::check()) {
        return Auth::user()->isAdmin() ? redirect('/admin/panel') : redirect('/events');
    }
    return redirect('/login');
})->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/panel', function () {
        return view('admin_panel');
    })->name('admin.panel');

    // crear nuevos eventos por admin
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/events/create', [AdminController::class, 'showCreateEventForm'])->name('admin.events.create');
        Route::post('/admin/events', [AdminController::class, 'storeEvent']);
        Route::get('/admin/events', [AdminController::class, 'listEvents'])->name('admin.events');
    });



    #Edit and update events
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/events/{event}/edit', [AdminController::class, 'editEvent'])->name('admin.events.edit');
        Route::put('/admin/events/{event}', [AdminController::class, 'updateEvent']);
        Route::delete('/admin/events/delete/{event}', [AdminController::class, 'deleteEvent'])->name('admin.events.delete');
    });




    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin/events/{event}/messages', [AdminController::class, 'showEventMessages'])->name('admin.event.messages');
        Route::delete('/admin/events/{event}/messages/{message}', [AdminController::class, 'deleteMessage'])->name('admin.event.message.delete');
    });



    // Editar users por el admin
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });





    // Route::get('/dashboard', function () {
    //     if (Auth::check()) {
    //         return Auth::user()->isAdmin() ? redirect('/admin/panel') : redirect('/events');
    //     }
    //     return redirect('/login');
    // })->middleware(['auth', 'verified'])->name('dashboard');



    Route::get('/admin/users', [AdminController::class, 'listUsers']);
    Route::post('/admin/users/{user}/change-role', [AdminController::class, 'changeUserRole']);
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser']);

    Route::get('/admin/events', [AdminController::class, 'listEvents']);
    Route::post('/admin/events', [AdminController::class, 'createEvent']);
    Route::put('/admin/events/{event}', [AdminController::class, 'updateEvent']);
    Route::delete('/admin/events/{event}', [AdminController::class, 'deleteEventMessage']);
});





Route::get('/events', [EventController::class, 'showEvents']); // Página de eventos
Route::get('/events/{eventId}/guestbook', [GuestbookEntryController::class, 'showGuestbook'])->name('guestbook.show');
Route::post('/events/{eventId}/guestbook', [GuestbookEntryController::class, 'store']);



require __DIR__ . '/auth.php';
