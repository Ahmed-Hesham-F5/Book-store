<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\ShopingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainAdminController;
use App\Models\Book;

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



Route::post('/register', UserController::class . '@register');
Route::post('/login', UserController::class . '@login')->middleware('IsNotBanned');

Route::group(['middleware' => 'auth:sanctum'], function () {
    //Route::post('/logout', UserController::class . '@logout');
    Route::post('/logout', UserController::class . '@logout');
    Route::post('addOrUpdatePersonalData', UserController::class .'@addOrUpdatePersonalData');
    Route::get('getPersonalData', UserController::class .'@getPersonalData');

    Route::get('getAllBooks', BooksController::class .'@getAllBooks');
    Route::get('/getBook/{bookId}', BooksController::class .'@getBook');
    Route::get('getOrCreateShopingCart',ShopingCart::class . '@getOrCreateShopingCart');
    Route::post('addBookToShopingCart',ShopingCart::class . '@addBookToShopingCart');
    /// cant be put
    Route::post('updateBookQuantityInShopingCart',ShopingCart::class . '@updateBookQuantityInShopingCart');
   
   Route::delete('deleteBookFromShopingCart',ShopingCart::class . '@deleteBookFromShopingCart');
   Route::post('checkout',ShopingCart::class . '@checkout');
   
   
  Route::group(['prefix'=> 'admin',"middleware"=> ['isAdmin','IsNotBanned']], function () { 
         Route::get('hello', function () {
            return response()->json(['message' => 'Hello Admin!'], 200);
          });  

        Route::get('getAllUsers', AdminController::class .'@getAllUsers');
        Route::post('banUser', AdminController::class .'@banUser');
        Route::post('unbanUser', AdminController::class .'@unbanUser');
        Route::post('addBook', BooksController::class .'@addBook');
    });
    Route::group(['prefix'=> 'Mainadmin',"middleware"=> 'IsMainAdmin'], function () { 
        Route::get('hello', function () {
           return response()->json(['message' => 'Hello main Admin!'], 200);
         });  

       Route::get('getAllUsers', MainAdminController::class .'@getAllUsers');
       Route::post('banUser', MainAdminController::class .'@banUser');
       Route::post('unbanUser', MainAdminController::class .'@unbanUser');

       Route::post('createAdmin', MainAdminController::class .'@createAdmin');
   });
   
});



