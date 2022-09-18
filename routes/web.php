<?php

use App\Http\Controllers\Daily\DailyController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Register\RegisterController;
use App\Http\Controllers\Task\TaskHandler;
use App\Http\Controllers\User\DayController;
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
Route::post("/login", [LoginController::class, "authenticate"])->name("login.index"); // diyorum ki kodda

Route::get("/register", [RegisterController::class, "index"])->name("register.index");
Route::post("/register/create", [RegisterController::class, "store"])->name("register.create");

Route::prefix("gorev")->middleware("admin.check")->group(function() {
    Route::get("/", [TaskHandler::class, "index"])->name("task.index");
    Route::get("/create", [TaskHandler::class, "create"])->name("task.create");
    
    Route::get("/finished", [TaskHandler::class, "finished"])->name("task.finished");

    Route::post("/save", [TaskHandler::class, "storage"])->name("task.save");
    Route::post("/list", [TaskHandler::class, "list"])->name("task.get");
}); 


Route::prefix("daily")->middleware("admin.check")->group(function() {
    Route::get("/", [DailyController::class, "index"])->name("daily.index");
    Route::post("/dailylist", [DailyController::class, "list"])->name("daily.dailylist");
    Route::get("/create", [TaskHandler::class, "create"])->name("daily.create");
    Route::post("/save", [DailyController::class, "storage"])->name("daily.save");
    Route::get("/finished", [TaskHandler::class, "finished"])->name("daily.finished");
    Route::get("/list", [DailyController::class, "list"])->name("daily.history");
});

Route::prefix("day")->middleware("admin.check")->group(function() {
    Route::post("/start", [DayController::class, "start"])->name("day.start");
    Route::post("/end", [DayController::class, "end"])->name("day.end");
});


/* Route::get("/user", function() {
    return view("layouts.default.child");
});
 */