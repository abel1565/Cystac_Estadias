<?php

use App\Http\Controllers\descargacontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tablausers', function () {return view('tablausers');})->name('tablausers');
Route::get('/facturasIngresos', function () {return view('facturasIngresos');})->name('Ingresos');
Route::get('/facturasEgresos', function () {return view('facturasEgresos');})->name('Egresos');
Route::get('/facturasNominas', function () {return view('facturasNominas');})->name('Nominas');
Route::get('pag1',function(){return view('pag1');})->name('pag1');
Route::post('DescargaCFDI',[descargacontroller::class, 'DescargaCFDI'])->name('Descarga_XML');


Route::get('editarusuarios/{id}',[UsuariosController::class,'editar'])->name('edituser.form');
Route::patch('editarusuarios/{id}',[UsuariosController::class,'updateusers'])->name('edituser.update');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
