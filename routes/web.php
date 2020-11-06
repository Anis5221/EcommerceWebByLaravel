<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin_LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\SubCategorieController;
use App\Http\Controllers\ManufectureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductByCategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\LoginController;
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
// frontend Section..................
Route::get('/',[HomeController::class, 'index']);

//Product showing by categoryId..............
Route::get('/product_by_category/{categorie_id}',[ProductByCategoryController::class, 'index_of_pdbyct']);
Route::get('/product_by_manufecture/{manufecture_id}',[ProductByCategoryController::class, 'index_of_pdbymn']);
Route::get('/pruduct-view/{id}',[ProductByCategoryController::class, 'pruduct_view_by_id']);


// Cart Section here.................
Route::post('/add-to-cart/{id}', [CartController::class, 'addCart']);
Route::get('/view-cart/', [CartController::class, 'viewCart']);
Route::get('/delete-item/{rawId}', [CartController::class, 'delete_cart_item']);
Route::post('/update-item/', [CartController::class, 'update_cart_item']);


// Check Out Section here .......................  
Route::get('/check-out-view/', [CheckOutController::class, 'index']);

// Login and signin section here........................... 
Route::get('/longin-to-view/',[LoginController::class, 'index']);
Route::post('/insert-customer/',[LoginController::class, 'insert']);
Route::post('/faching-customer-login/',[LoginController::class, 'login']);




// backend Section....................
Route::get('/log-out', [SuperAdminController::class, 'logout']);
Route::get('/admin',[AdminController::class, 'index']);
Route::get('/dashboard',[SuperAdminController::class, 'index']);
Route::post('/admin_login',[AdminController::class, 'adminLogin']);


// Categories Section....................
Route::get('/all-category',[CategorieController::class, 'all_category']);
Route::get('/add-category',[CategorieController::class, 'index']);
Route::post('/insert-category',[CategorieController::class, 'insert']);
Route::get('/unActive_category/{categorie_id}',[CategorieController::class, 'unActive_category']);
Route::get('/active_category/{categorie_id}', [CategorieController::class, 'active_category']);
Route::get('/edit_category/{categorie_id}', [CategorieController::class, 'edit_category']);
Route::post('/update_category/{categorie_id}', [CategorieController::class, 'update_category']);
Route::get('/delete_category/{categorie_id}', [CategorieController::class, 'destroy_category']);

// sub Category Section ...................
Route::get('/show.subcategory/', [SubCategorieController::class, 'index']);
Route::post('/addSub_category', [SubCategorieController::class, 'insert']);
Route::post('/update.subcategory',[SubCategorieController::class, 'update']);
Route::get('/delete_subcategory/{subcategorie_id}', [SubCategorieController::class, 'destroy']);
Route::get('/unActive_subcategory/{subcategorie_id}', [SubCategorieController::class, 'unActive_category']);
Route::get('/active_subcategory/{subcategorie_id}', [SubCategorieController::class, 'active_category']);


// Brand or Manufecture Section..........
Route::get('/all-manufecture', [ManufectureController::class, 'index']);
Route::get('/add-manufecture', [ManufectureController::class, 'add_manufecture']);
Route::post('/insert-manufecture', [ManufectureController::class, 'insert']);
Route::get('/edit_manu/{manufecture_id}',[ManufectureController::class, 'edit']);
Route::post('/update_manu/{manufecture_id}', [ManufectureController::class, 'update']);
Route::get('/unActive_manu/{manufecture_id}', [ManufectureController::class, 'unactive']);
Route::get('/active_manu/{manufecture_id}', [ManufectureController::class, 'active']);
Route::get('/delete_manu/{manufecture_id}', [ManufectureController::class, 'destroy']);


// Product Section here....................
Route::get('/add-product',[ProductController::class, 'index']);
Route::post('/insert-product',[ProductController::class, 'insert']);
Route::get('/all-product', [ProductController::class, 'show']);
Route::get('/edit_product/{id}', [ProductController::class, 'edit']);
Route::post('/update_product/{id}', [ProductController::class, 'update']);
Route::get('/delete_product/{id}', [ProductController::class, 'destroy']);
Route::get('/unActive_product/{id}', [ProductController::class, 'unactive']);
Route::get('/active_product/{id}', [ProductController::class, 'active']);

// Slider Section here......................
Route::get('/add-slider', [SliderController::class, 'index']);
Route::post('/insert-slider', [SliderController::class, 'insert']);
Route::get('/all-slider', [SliderController::class, 'show']);
Route::get('/delete_slider/{id}', [SliderController::class, 'destroy']);
Route::get('/unActive_slider/{id}', [SliderController::class, 'unactive']);
Route::get('/active_slider/{id}', [SliderController::class, 'active']);

