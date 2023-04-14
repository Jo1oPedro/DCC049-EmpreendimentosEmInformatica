<?php

use App\Http\Controllers\AnnotationController as AnnotationController;
use App\Http\Controllers\ExamController as ExamController;
use App\Http\Controllers\LoginController as LoginController;
use App\Http\Controllers\PeriodController as PeriodController;
use App\Http\Controllers\SubjectController as SubjectController;
use App\Http\Controllers\TaskController as TaskController;
use App\Http\Controllers\TypeController as TypeController;
use App\Http\Controllers\UserController as UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('anotacoes', AnnotationController::class);
    Route::resource('exames', ExamController::class);
    Route::resource('periodos', PeriodController::class);
    Route::resource('materias', SubjectController::class);
    Route::resource('tarefas', TaskController::class);
    Route::resource('tipos', TypeController::class);
    Route::resource('usuarios', UserController::class);
});

Route::post('login', [LoginController::class, 'login']);


