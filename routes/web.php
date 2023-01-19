<?php

use App\Http\Controllers\Admin\CashierController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard');
});

//Admin
Route::prefix('admin')->group(function () {
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);

    Route::get('cashier', [CashierController::class, 'index'])->name('cashier.index');
    Route::get('cashier/transactions', [CashierController::class, 'create'])->name('cashier.create');
    Route::get('menu/{category_id}', [CashierController::class, 'showMenu'])->name('cashier.showMenu');
    Route::post('cashier/transactions', [CashierController::class, 'store'])->name('cashier.store');
    Route::delete('/cashier/{id}', [CashierController::class, 'destroy'])->name('cashier.destroy');

    Route::get('transactions', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('transactions/{id}/products', [TransactionController::class, 'detailProduct'])->name('transaction.detailProduct');
});
