<?php

use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Hospital\DoctorController;
use App\Http\Controllers\Hospital\PatientController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

//------------CHAT------------//
Route::get('/chat', [ChatController::class, 'showChat'])->name('chat');

Route::middleware('ajax')
    ->prefix('/api')
    ->group(function(Router $router) {

        $router->get('/users', [ChatController::class, 'index']);
        $router->post('/send/message', [ChatController::class, 'sendMessage']);
        $router->get('/messages', [ChatController::class, 'getMessages']);
        $router->post('/create/room', [ChatController::class, 'createRoom']);
        $router->get('/chat/rooms', [ChatController::class, 'getChatRooms']);
        $router->get('get/room/{id}', [ChatController::class, 'getRoomMessages']);
        $router->post('send/room/message', [ChatController::class, 'sendRoomMessage']);


        $router->get('/users/list', [UserController::class, 'usersList']);
        $router->post('/edit/user/{id}', [UserController::class, 'updateUser']);
        $router->post('/delete/user/{id}', [UserController::class, 'deleteUser']);
        $router->get('/make/appointment', [PatientController::class, 'makeAppointment']);
        $router->post('/save/appointment', [PatientController::class, 'saveAppointment']);
    });


//------------USER------------//
Route::get('/home', [UserController::class, 'index'])->name('home');
Route::get('/add/user', [UserController::class, 'create'])->name('add.user');
Route::post('/save/user', [UserController::class, 'store'])->name('save.user');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');


//------------PATIENT------------//
Route::get('/add/patient', [PatientController::class, 'create'])->name('add.patient');
Route::post('/save/patient', [PatientController::class, 'store'])->name('save.patient');


//------------DOCTOR------------//
Route::get('/add/doctor', [DoctorController::class, 'create'])->name('add.doctor');
Route::post('/save/doctor', [DoctorController::class, 'store'])->name('save.doctor');


Route::get('/users/list', [UserController::class, 'users'])->name('users.list');
Route::get('/make/appointment', [PatientController::class, 'makeAppointmentView'])->name('make.appointment.view');
