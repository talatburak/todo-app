<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Register\RegisterController;
use App\Http\Controllers\Task\TaskHandler;
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

Route::get('/', [IndexController::class, "index"])->name("index");

Route::post("/login", [LoginController::class, "authenticate"])->name("login.index");

Route::get("/register", [RegisterController::class, "index"])->name("register.index");
Route::post("/register/create", [RegisterController::class, "store"])->name("register.create");

Route::prefix("gorev")->group(function() {
    Route::get("/", [TaskHandler::class, "index"])->name("task.index");
    Route::get("/create", [TaskHandler::class, "create"])->name("task.create");
    Route::post("/save", [TaskHandler::class, "storage"])->name("task.save");
    Route::get("/finished", [TaskHandler::class, "finished"])->name("task.finished");
});


/* Route::get("/user", function() {
    return view("layouts.default.child");
});
 */