<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OnlineOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FeedbackController;


Route::get('/reservation', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

Route::get('/fetch-products', [ProductController::class, 'fetchProducts'])->name('products.fetch');
Route::get('/product-details/{id}', [ProductController::class, 'show'])->name('products.show');

route::get('/',[TemplateController::class,'index']);
route::get('/menu',[TemplateController::class,'index1']);
route::get('/book',[TemplateController::class,'index2']);
route::get('/about',[TemplateController::class,'index3']);
route::get('/showcart',[CartController::class,'showcart'])->name('pages.showcart');
route::get('feedback',[TemplateController::class,'feedback'])->name('pages.feedback');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

route::post('/addcart/{id}',[CartController::class,'addcart']);
Route::get('/delete/{id}', [CartController::class, 'deletecart']);
Route::post('/api/online-orders', [OnlineOrderController::class, 'store'])->name('online-orders.store');
Route::get('myorders', [OrderController::class,'myorders']);

//firebase route
Route::post('Add-feedback', [FeedbackController::class,'store']);

