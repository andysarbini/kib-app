<?php

use App\Http\Controllers\{
    DashboardController,
    SektorController
};

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

Route::group([
    'middleware' => ['auth', 'role:admin,guest'],
    'prefix' => 'admin'
], function() {
    // Route::get('/', function () {
    //     return redirect()->route('dashboard');
    // });
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
    Route::resource('/sektor', SektorController::class);

    // Route::get('/dashboard', function () {
    //     return redirect()->route('dashboard');
    // });
});
