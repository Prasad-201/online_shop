<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController; // Corrected namespace
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\admin\TempImageController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\BrandsController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\admin\ProductSubcategoryController;


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
//Front End Routes

Route::get('/', [FrontController::class,'index'])->name('front.home'); 

//**************************************** */


// Route::get('/', function () {
//     return view('welcome');
// });




Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin.login'); 
Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard'); 

// Category Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');

//category Image route
Route::post('/upload-temp-image', [TempImageController::class, 'create'])->name('temp-images.create');


Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create'); 
Route::post('/categories/store', [CategoryController::class, 'store'])->name('category.store'); 

Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit'); 
Route::get('/categories/{category}/put', [CategoryController::class, 'update'])->name('category.update');


Route::get('/getSlug', function(Request $request) {
    $slug = '';
    if (!empty($request->title)) {
        $slug = Str::slug($request->title);
    }
    return response()->json([
        'status' => true,
        'slug' => $slug,
    ]);
})->name('getSlug');

//sub_categories
Route::get('/sub_categories/create', [SubCategoryController::class, 'create'])->name('sub_category.create'); 
Route::post('/sub_categories/store', [SubCategoryController::class, 'store'])->name('sub_category.store'); 
Route::get('/sub_categories', [SubCategoryController::class, 'index'])->name('sub_categories.index'); 

//Brands 
Route::get('/brands/create', [BrandsController::class, 'create'])->name('brands.create'); 
Route::post('/brands/store', [BrandsController::class, 'store'])->name('brands.store');
Route::get('/brands', [BrandsController::class, 'index'])->name('brands.index'); 

//products
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); 
Route::get('/product-subcategories', [ProductSubcategoryController::class, 'index'])->name('product-subcategories.index'); 
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/', [ProductController::class, 'index'])->name('products.index');

// Route::get('/products/', [ProductController::class, 'index'])->name('products.index');
