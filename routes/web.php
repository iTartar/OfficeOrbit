<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScheduleDetailController;
use App\Http\Controllers\ScheduleUserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ScrController;

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::put ('/user/{user}',[UserController::class, 'update'])->name('user.update');
Route::delete ('/user/{user}',[UserController::class, 'destroy'])->name('user.destroy');

Route::get('/project', [ProjectController::class, 'index'])->name('project.index');
Route::post('/project', [ProjectController::class, 'store'])->name(name: 'project.store');
Route::put ('/project/{project}',[ProjectController::class, 'update'])->name('project.update');
Route::delete('/project/{project}',[ProjectController::class,'destroy'])->name('project.destroy');

Route::get('/meeting', [MeetingController::class, 'index'])->name('meeting.index');
Route::post('/meeting', [MeetingController::class, 'store'])->name('meeting.store');
Route::put ('/meeting/{meeting}',[MeetingController::class, 'update'])->name('meeting.update');
Route::delete('/meeting/{meeting}',[MeetingController::class,'destroy'])->name('meeting.destroy');

Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');
Route::post('/notification', [NotificationController::class, 'store'])->name('notification.store');
Route::put ('/notification/{notification}',[NotificationController::class, 'update'])->name('notification.update');
Route::delete('/notification/{notification}',[NotificationController::class,'destroy'])->name('notification.destroy');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
Route::get('/schedule/{schedule}', [ScheduleController::class, 'show'])->name('schedule.show');
Route::put('/schedule/{schedule}', [ScheduleController::class, 'update'])->name('schedule.update');
Route::delete('/schedule/{schedule}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

Route::get('/schedules/{schedule}', [ScheduleDetailController::class, 'show'])->name('schedule.show');
Route::post('/schedule-details', [ScheduleDetailController::class, 'store'])->name('schedule-details.store');
Route::put('/schedule-details/{scheduleDetail}', [ScheduleDetailController::class, 'update'])->name('schedule-details.update');
Route::delete('/schedule-details/{scheduleDetail}', [ScheduleDetailController::class, 'destroy'])->name('schedule-details.destroy');

Route::get('/schedule_user', [ScheduleUserController::class, 'index']);
Route::post('/assign-schedule', [ScheduleUserController::class, 'assign'])->name('schedule-user.assign');

Route::get('/calendar/{userId}', [CalendarController::class, 'show'])->name('calendar.show');

Route::get('/presence', [PresenceController::class, 'index'])->name('presence');

Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
Route::put('/employee/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employee/{employee}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

Route::get('/scr', [ScrController::class, 'index'])->name('scr');

