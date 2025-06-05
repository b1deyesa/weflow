<?php

use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\TeamController;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    Route::namespace('Auth')->name('auth.')->group(function () {
        Route::get('/', 'LoginController@index')->name('login.index');
        Route::post('/', 'LoginController@post')->name('login.post');
    });
    Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', 'IndexController@index')->name('index');
        Route::resource('employee', 'EmployeeController');
        Route::resource('salary', 'SalaryController');
        Route::resource('detail-salary', 'DetailSalaryController');
        Route::resource('course', 'CourseController');
        Route::resource('customer', 'CustomerController');
        Route::resource('team', 'TeamController');
        Route::resource('game', 'GameController');
        Route::resource('payment', 'PaymentController');
        Route::post('/games/update-scores', [GameController::class, 'updateScores'])->name('games.update-scores');
        Route::namespace('Setting')->name('setting.')->group(function () {
            Route::get('/setting/user', 'UserController@index')->name('user.index');
        });
    });
});
