<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\BonSortieController;
use App\Http\Controllers\MagasinerController;
use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\FactureAchatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommercialController;


Route::get('/', function () {
	return view('auth.login');
});

Auth::routes();

Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
});

Route::resource('facturedevents', FactureVenteController::class);
Route::get('/facturedevents/calculate-total/{id}', [FactureVenteController::class,'calculateTotalAmount'])->name('facturedevents.calculateTotalAmount');

Route::resource('facturedachats', FactureAchatController::class);

Route::resource('users', UserController::class);

Route::resource('product', ProductController::class);
Route::get('/products/all', [ProductController::class, 'getAllProducts'])->name('products.all');
Route::post('product/import', [ProductController::class,'ProductsImport'])->name('product.import');

Route::put('/product/{id}/updatePrice', [ProductController::class ,'updatePrice'])->name('product.updatePrice');
Route::put('/product/{id}/replenishStock',[ProductController::class,'replenishStock'])->name('product.replenishStock');
Route::get('/products/search', [ProductController::class,'search'])->name('products.search');

// Resource routes for CategoryController
Route::resource('category', CategoryController::class);

// Resource routes for ClientController
Route::post('clients/import/', [ClientController::class,'importClients'])->name('clients.import');
Route::post('category/import/', [CategoryController::class,'CategoriesImport'])->name('category.import');

Route::resource('clientes', ClientController::class);



// Resource routes for EmployeeController
Route::resource('employee', EmployeeController::class);

// Resource routes for StockController
Route::resource('stock', StockController::class);

Route::get('/stock/{id}/checkSpace', [StockController::class, 'checkSpace'] )->name('stock.checkSpace');
Route::match(['get', 'post'], '/stock/{id}/manageMovements', [StockController::class, 'manageMovements'])->name('stock.manageMovements.post');
Route::get('/employee/inventory/{id}', [EmployeeController::class, 'performInventory'])->name('employee.performInventory');

Route::get('/employee/{id}/problèmes_de_stock', [EmployeeController::class,'showStockIssues'])->name('employee.problèmes_de_stock');
Route::post('/employees/{id}/report-stock-issue', [EmployeeController::class,'reportStockIssue'])->name('employee.reportStockIssue');


Route::resource('bonsorties', BonSortieController::class);
Route::put('bonsorties/{id}/update-status', 'BonSortieController@updateStatus')->name('bonsorties.updateStatus');

Route::post('/bonsorties/{id}/verify', [BonSortieController::class,'verify'])->name('bonsorties.verify');

Route::put('/bonsorties/{id}/update-sortie', [BonSortieController::class, 'updateSortie'])->name('bonsorties.update-sortie');
Route::get('/bonsorties/{id}/confirm-sortie', [BonSortieController::class, 'confirmSortie'])->name('bonsorties.confirmSortie');
Route::put('/bonsorties/{id}/reject-with-justification', [BonSortieController::class,'rejectWithJustification'])->name('bonsorties.reject-with-justification');



Route::get('/commercial/bons-sorties-awaiting-verification', [CommercialController::class,'bonsSortiesAwaitingVerification'])->name('commercial.bons_sorties_awaiting_verification');

// Resource routes for Facture d'achatController

// Resource routes for SaleInvoiceController
 
// Resource routes for BonSortieController
 
// Resource routes for FactureDachatController
 // Add this route in your web.php file
// Modify the route to include the auth middleware
// web.php
// web.php
 
// routes/web.php


Route::post('/home/markAllNotificationsAsRead', [HomeController::class, 'markAllNotificationsAsRead'])
    ->name('home.markAllNotificationsAsRead');
Route::put('/notifications/markAsRead/{id}', [NotificationController::class,'markAsRead'])->name('notifications.markAsRead');

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/Admin/admin-page', [AdminController::class, 'adminHome'])->name('Admin.admin-page');
    
    // Resource routes for FactureVenteController

});
// web.php
Route::prefix('bonsorties')->group(function () {
    Route::post('{bonsortie}/accept', [BonSortieController::class, 'accept'])->name('bonsorties.accept');
    Route::post('{bonsortie}/reject', [BonSortieController::class, 'reject'])->name('bonsorties.reject'); // Update this line
});

Route::get('bonsorties/{id}/print', [BonSortieController::class, 'print'])->name('bonsorties.print');

Route::get('/fetch-notifications', [NotificationController::class, 'fetchNotifications']);
Route::put('/bonsorties/{id}/update-status', [BonSortieController::class, 'updateStatus'])->name('bonsorties.update-status');

Route::middleware(['auth', 'user-access:Magasiner'])->group(function () {
    Route::get('/Magasiner/magasiner-page', [MagasinierController::class, 'managerHome'])->name('Magasiner.magasiner-page');
    Route::get('/Magasiner/notifications', [MagasinierController:: class ,'showNotifications'])->name('magasiner.notifications');

});

// web.php

Route::middleware(['auth', 'user-access:Commercial'])->group(function () {
    Route::get('/commercial/home-page', [CommercialController::class, 'commercialHome'])->name('commercial.home-page');
    Route::get('/commercial/notifications', [CommercialController::class, 'showNotifications'])->name('commercial.notifications');
});



// web.php

 
