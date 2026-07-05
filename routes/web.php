<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SysAdminController;
use Illuminate\Support\Facades\Route;


// only for guests and clients routes
Route::middleware(['can:guest-or-client'])->group(function() {
    
    Route::get('/', [MainController::class, 'index'])->name('home');

    Route::get('/contact-us', [MainController::class, 'contactUs'])->name('contact.us');
    Route::get('/about-us', [MainController::class, 'aboutUs'])->name('about.us');

    Route::get('/services', [ServicesController::class, 'index'])->name('services');
    Route::get('/services/service-description/{service_id}', [ServicesController::class, 'serviceDescription'])->name('services.service.description');

});

// auth only for clients routes
Route::middleware(['auth', 'can:client'])->group(function() {

    Route::get('/new-appointment/{service_id}', [AppointmentsController::class, 'newAppointment'])->name('appointments.new.appointment');
    Route::post('/new-appointment/{service_id}', [AppointmentsController::class, 'newAppointmentSubmit'])->name('appointments.new.appointment.submit');
    Route::get('/profile', [MainController::class, 'profile'])->name('profile');
    Route::get('/appointment-details/{appointment_id}', [MainController::class, 'appointmentDetails'])->name('appointments.details');

});

// guest routes
Route::middleware(['guest'])->group(function() {

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.submit');
    
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');

});

// any auth routes
Route::middleware(['auth'])->group(function() {

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/appointments/occupied-times', [AppointmentsController::class, 'occupiedTimes']);

});

// only admin routes
Route::middleware(['auth', 'can:admin'])->group(function() {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/admin/appointment-details/{appointment_id}', [AdminController::class, 'appointmentDetails'])->name('admin.appointment.details');

    Route::get('/admin/start-appointment/{appointment_id}', [AdminController::class, 'startAppointment'])->name('admin.start.appointment');
    Route::get('/admin/finish-appointment/{appointment_id}', [AdminController::class, 'finishAppointment'])->name('admin.finish.appointment');
    Route::get('/admin/cancel-appointment/{appointment_id}', [AdminController::class, 'cancelAppointment'])->name('admin.cancel.appointment');
    Route::get('/admin/reactivate-appointment/{appointment_id}', [AdminController::class, 'reactivateAppointment'])->name('admin.reactivate.appointment');
    Route::get('/admin/delivered-appointment/{appointment_id}', [AdminController::class, 'deliveredAppointment'])->name('admin.delivered.appointment');
    Route::post('/admin/assign-appointment-responsible/{appointment_id}', [AdminController::class, 'assignResponsible'])->name('admin.assign.appointmet.responsible');
});

// only sys-admin routes
Route::middleware(['auth', 'can:sys-admin'])->group(function() {

    Route::get('/sys-admin', [SysAdminController::class, 'index'])->name('sysadmin.home');
    
    Route::get('/sys-admin/user/create', [SysAdminController::class, 'createUser'])->name('sysadmin.user.create');
    Route::post('/sys-admin/user/create', [SysAdminController::class, 'createUserSubmit'])->name('sysadmin.user.create.submit');
    
    Route::get('/sys-admin/user/force-password-reset/{id}', [SysAdminController::class, 'forcePasswordReset'])->name('sysadmin.user.force.password.reset');
    Route::post('/sys-admin/user/force-password-reset/{id}/confirm', [SysAdminController::class, 'forcePasswordResetConfirm'])->name('sysadmin.user.force.password.reset.confirm');
    
    Route::get('/sys-admin/user/deactivate/{id}', [SysAdminController::class, 'deactivateUser'])->name('sysadmin.user.deactivate');
    Route::get('/sys-admin/user/activate/{id}', [SysAdminController::class, 'activateUser'])->name('sysadmin.user.activate');
    
    Route::get('/sys-admin/user/block/{id}', [SysAdminController::class, 'blockUser'])->name('sysadmin.user.block');
    Route::post('/sys-admin/user/block', [SysAdminController::class, 'blockUserSubmit'])->name('sysadmin.user.block.submit');
    Route::get('/sys-admin/user/unblock/{id}', [SysAdminController::class, 'unblockUser'])->name('sysadmin.user.unblock');
    
    Route::get('/sys-admin/user/delete/{id}', [SysAdminController::class, 'deleteUser'])->name('sysadmin.user.delete');
    Route::get('/sys-admin/user/restore/{id}', [SysAdminController::class, 'restoreUser'])->name('sysadmin.user.restore');
    
    


});