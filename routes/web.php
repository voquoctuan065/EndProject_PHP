<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//-----------------------------------------------Home Controller-----------------------------------------//

// If user == 1 (admin) redirect to admin page else user == 0 (customer) redirect customer page
route::get('/redirect', [HomeController::class, 'redirect']);
route::get('/', [HomeController::class, 'index']);
// Product details page
route::get('/product_details/{id}', [HomeController::class, 'product_details']);

// Add product to cart
route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
// Display item in cart
route::get('/show_cart', [HomeController::class, 'show_cart']);
// Delete item from cart
route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);
// Cash on delivery
route::get('/cash_order', [HomeController::class, 'cash_order']);
// Payment method using card
route::get('/stripe/{total_price}', [HomeController::class, 'stripe']);
Route::post('stripe/{total_price}', [HomeController::class, 'stripePost'])->name('stripe.post');
// show Order in customer page
route::get('/show_order', [HomeController::class, 'show_order']);
// Cancel order
route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);

//--------------------------------------- Admin Controller -----------------------------------------------------//

// Display category
route::get('/view_category', [AdminController::class, 'view_category']);
// Add new category
route::post('/add_category', [AdminController::class, 'add_category']);
// Delete category
route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

// Display view product in admin panel
route::get('/view_product', [AdminController::class, 'view_product']);
// Add new product to database
route::post('/add_product', [AdminController::class, 'add_product']);
// Display all product in database
route::get('/show_product', [AdminController::class, 'show_product']);
// Delete product from database
route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
// Edit product view
route::get('/update_product/{id}', [AdminController::class, 'update_product']);
// Confirm edit action
route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);

// Display all order
route::get('/view_order', [AdminController::class, 'view_order']);
// Update delivery of order
route::get('/delivered/{id}', [AdminController::class, 'delivered']);
// print pdf
route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);
// Search in order
route::get('/search', [AdminController::class, 'search_data']);
