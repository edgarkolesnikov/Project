<?php

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

//Route::get('/', function () {
//    return view('Home');
//});
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('landingPage');
Route::get('/userProvideDetails', [App\Http\Controllers\UserDetailsController::class, 'create']);
Auth::routes();

Route::get('/change-password', [App\Http\Controllers\FunctionalityController::class, 'editPassword'])->name('functionality.passwordEdit');
Route::post('/update-password', [App\Http\Controllers\FunctionalityController::class, 'updatePassword'])->name('functionality.updatePassword');
Route::post('/search', [App\Http\Controllers\FunctionalityController::class, 'search'])->name('search.all');
Route::delete('/deleteImage/{id}', [App\Http\Controllers\FunctionalityController::class, 'deleteImage'])->name('deleteImage');
Route::post('/product/filtered', [App\Http\Controllers\FunctionalityController::class, 'filteredProducts'])->name('filtered.products');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/product/popular-products', [App\Http\Controllers\ProductsController::class, 'popularProducts'])->name('popular.products');
Route::get('/product/newest-products', [App\Http\Controllers\ProductsController::class, 'newestProducts'])->name('newest.products');
Route::get('/product/favourite/{id}', [App\Http\Controllers\ProductsController::class, 'favouriteProduct'])->name('favouriteProduct');
Route::get('/product/unfavourite/{id}', [App\Http\Controllers\ProductsController::class, 'unfavouriteProduct'])->name('unfavouriteProduct');
Route::get('/product/myFavourite', [App\Http\Controllers\ProductsController::class, 'userFavouritesProducts'])->name('product.userFavouritesProducts');
Route::post('/product/deactivate', [App\Http\Controllers\ProductsController::class, 'deactivate'])->name('product.deactivate');

Route::get('/user/Products/{id}', [App\Http\Controllers\ProductsController::class, 'usersProducts'])->name('product.usersProducts');
Route::get('/user/profile/{id}', [App\Http\Controllers\UserDetailsController::class, 'userProfile'])->name('user.profile');
Route::get('/user/reviews/{id}', [App\Http\Controllers\UserDetailsController::class, 'userReviews'])->name('userDetails.reviews');

Route::get('admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::get('admin/products/list', [App\Http\Controllers\AdminController::class, 'products'])->name('admin.products');
Route::post('admin/products', [App\Http\Controllers\AdminController::class, 'productDelete'])->name('admin.productDelete');
Route::post('admin/userRole', [App\Http\Controllers\AdminController::class, 'userRoleUpdate'])->name('admin.userRoleUpdate');
Route::get('admin/comments', [App\Http\Controllers\AdminController::class, 'userComments'])->name('admin.comments');

Route::resource('product', 'App\Http\Controllers\ProductsController');
Route::resource('user', 'App\Http\Controllers\UserDetailsController');
Route::resource('userDetails', 'App\Http\Controllers\UserDetailsController');
Route::resource('comments', 'App\Http\Controllers\CommentsController');
Route::resource('messages', 'App\Http\Controllers\MessagesController');

Route::get('/messages/write/{receiverId}', [App\Http\Controllers\MessagesController::class, 'create'])->name('messages.create');
Route::get('/messages/inbox', [App\Http\Controllers\MessagesController::class, 'inbox'])->name('messages.inbox');
Route::get('/messages/read/{chatFriendId}', [App\Http\Controllers\MessagesController::class, 'read'])->name('messages.read');
