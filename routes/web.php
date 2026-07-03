<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;







/*     
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});







Route::get('operations/index', [OperationController::class, 'index'])->name('opr.index');
Route::post('operations/search', [OperationController::class ,'Search_operation'] )->name('opr.search');



Route::get('departments/edit', [DepsController::class, 'edit'])->name('deps.edit');
Route::get('departments/index', [DepsController::class, 'index'])->name('deps.index')->middleware(middleware: 'check.sidebar.permissions');
Route::POST('departments/destroy', [DepsController::class, 'destroy'])->name('deps.destroy');
Route::delete('departments/destroy/all', [DepsController::class, 'destroyAll'])->name('deps.destroy.all');
Route::POST('departments/update', [DepsController::class, 'update'])->name('deps.update');
Route::post('departments/store', [DepsController::class, 'store'])->name('deps.store');


Route::get('products/index', [ProductController::class, 'index'])->name('prod.index')->middleware(middleware: 'check.sidebar.permissions');
Route::post('products/store', [ProductController::class, 'store'])->name('prod.store');
Route::POST('products/update', [ProductController::class, 'update'])->name('prod.update');
Route::POST('products/destroy', [ProductController::class, 'destroy'])->name('prod.destroy');



Route::get('storage/reports/index', [StorageController::class, 'reports_index'])->name('stor.reports.index');
Route::POST('storage/reports/search', [StorageController::class, 'reports_search'])->name('stor.reports.search');
Route::get('storage/edit', [StorageController::class, 'edit'])->name('stor.edit');
Route::get('storage/index', [StorageController::class, 'index'])->name('stor.index')->middleware(middleware: 'check.sidebar.permissions');
Route::post('storage/store', [StorageController::class, 'store'])->name('stor.store');
Route::get('storage/search', [StorageController::class, 'search'])->name('stor.search');
Route::POST('storage/destroy', [StorageController::class, 'destroy'])->name('stor.destroy');
Route::delete('storage/destroy/all', [StorageController::class, 'destroyAll'])->name('stor.destroy.all');
Route::POST('storage/update', [StorageController::class, 'update'])->name('stor.update');


Route::get('exports/reports/index', [ExportController::class, 'reports_index'])->name('exp.reports.index');
Route::post('exports/reports/search', [ExportController::class, 'reports_search'])->name('exp.reports.search');
Route::get('exports/index', [ExportController::class, 'index'])->name('exp.index');
Route::post('exports/store', [ExportController::class, 'store'])->name('exp.store');
Route::POST('exports/destroy', [ExportController::class, 'destroy'])->name('exp.destroy');
Route::delete('exports/destroy/all', [ExportController::class, 'destroyAll'])->name('exp.destroy.all');
Route::POST('exports/update', [ExportController::class, 'update'])->name('exp.update');


Route::get('users/index', [UserController::class, 'index'])->name('users.index')->middleware(middleware: 'check.sidebar.permissions');
Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
Route::post('users/add', [UserController::class, 'store'])->name('users.store');
Route::post('users/delete', [UserController::class, 'destroy'])->name('users.destroy');
Route::delete('users/destroy/all', [UserController::class, 'destroyAll'])->name('users.destroy.all');
Route::post('users/change/prev', [UserController::class, 'changePrev'])->name('users.change.prev');


Route::get('home', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
    