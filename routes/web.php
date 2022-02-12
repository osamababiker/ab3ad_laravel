<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\DriversController; 
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ItemsController;


require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('index');
});

Route::get('/admin-dashboard',
    [HomeController::class,'index']
)->middleware(['admin'])->name('dashboard');


// Route form app users
Route::get(
    '/dashboard/users/table',
    [UsersController::class,'getTable']
)->middleware(['admin'])->name('usersTable');

// Route form app drivers
Route::get(
    '/dashboard/drivers/table',
    [DriversController::class,'getTable']
)->middleware(['admin'])->name('driversTable');

Route::post( 
    '/dashboard/drivers/table',
    [DriversController::class,'postTable']
)->middleware(['admin'])->name('driversTable');

Route::get(
    '/dashboard/drivers/table/driverReport/{driverId}',
    [DriversController::class,'getDriverReport']
)->middleware(['admin'])->name('driversTable.driverReport');

Route::post(
    '/dashboard/drivers/table/driverReport/{driverId}',
    [DriversController::class,'postDriverReport']
)->middleware(['admin'])->name('driversTable.driverReport');


// Route users orders
Route::get(
    '/dashboard/orders/table',
    [OrdersController::class,'getTable']
)->middleware(['admin'])->name('ordersTable');




// Route to add new category
Route::get(
    '/dashboard/categories/form',
    [CategoriesController::class,'getForm']
)->middleware(['admin'])->name('categoriesForm');
Route::post(
    '/dashboard/categories/form',
    [CategoriesController::class,'postForm']
)->middleware(['admin'])->name('categoriesForm');
// Route to manage categories table
Route::get(
    '/dashboard/categories/table',
    [CategoriesController::class,'getTable']
)->middleware(['admin'])->name('categoriesTable');
Route::post(
    '/dashboard/categories/table',
    [CategoriesController::class,'postTable']
)->middleware(['admin'])->name('categoriesTable');


// Route to add new item
Route::get(
    '/dashboard/items/form',
    [ItemsController::class,'getForm']
)->middleware(['admin'])->name('itemsForm');
Route::post(
    '/dashboard/items/form',
    [ItemsController::class,'postForm']
)->middleware(['admin'])->name('itemsForm');
// to get items table page
Route::get(
    '/dashboard/items/table',
    [ItemsController::class, 'getTable']
)->middleware(['admin'])->name('itemsTable');
// to get get items table
Route::post(
    '/dashboard/items/table',
    [ItemsController::class, 'postTable']
)->middleware(['admin'])->name('itemsTable');



// to get setting table page
Route::get(
    '/dashboard/settings/table',
    [SettingsController::class, 'getTable']
)->middleware(['admin'])->name('settingsTable');
// to get get settings table
Route::post(
    '/dashboard/settings/table',
    [SettingsController::class, 'postTable']
)->middleware(['admin'])->name('settingsTable');
