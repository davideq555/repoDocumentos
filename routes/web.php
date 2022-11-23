<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Categorias;
use App\Http\Livewire\Departamentos;
use App\Http\Livewire\Documentos;
use App\Http\Livewire\SearchDocumento;
use App\Http\Livewire\MostrarUsers;

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
    return view('inicio');
})->name('home');


Route::get('lista', SearchDocumento::class)->name('lista');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/documentos/export/', [Documentos::class, 'export'])->name('exportExcel');
    Route::get('/categorias', Categorias::class)->name('categorias');
    Route::get('/departamentos', Departamentos::class)->name('departamentos');
    Route::get('/documentos', Documentos::class)->name('documentos');
    Route::get('/usuarios', MostrarUsers::class)->name('usuarios');
});
