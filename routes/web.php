<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\BokkingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\BokkingController as AdminBokkingController;
use App\Http\Controllers\Auth\RegisteredUserController;

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

Route::get('/', [ImageController::class, 'show'])->name('index');
Route::match(['get', 'post'], '/rooms/{image}', [ImageController::class, 'rooms'])->name('image.rooms');
Route::post('/rooms/{image}/saveBokking', [ImageController::class, 'saveBokking'])->name('image.saveBokking');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/bokking/{id}', [ImageController::class, 'bokkingDetails'])->name('bokking.details');
Route::post('/bokking/{id}/add-comment', [ImageController::class, 'addCommentToBokking'])->name('bokking.addComment');
Route::get('/booking', [BokkingController::class, 'showbokkings'])->name('showbokkings')->middleware('auth');

/*Paginas de Administracion */

Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->user_type === 'admin') {
        return view('admin.index');
    } else {
        return redirect('http://127.0.0.1:8000/');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

/*Usuarios*/

Route::get('admin/users', [AdminUserController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.users.index');
Route::delete('admin/users/{user}', [AdminUserController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.users.destroy');
Route::get('admin/users/{user}/edit', [AdminUserController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.users.edit');
Route::put('admin/users/{user}', [AdminUserController::class, 'update'])->middleware(['auth', 'verified'])->name('admin.users.update');

/*Categorias*/

Route::get('admin/categories', [AdminCategoryController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.categories.index');
Route::get('admin/categories/create', [AdminCategoryController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.categories.create');
Route::post('admin/categories', [AdminCategoryController::class, 'store'])->middleware(['auth', 'verified'])->name('admin.categories.store');
Route::get('admin/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.categories.edit');
Route::put('admin/categories/{category}', [AdminCategoryController::class, 'update'])->middleware(['auth', 'verified'])->name('admin.categories.update');
Route::delete('admin/categories/{category}', [AdminCategoryController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.categories.destroy');

/*Habitaciones*/

Route::get('admin/rooms', [AdminRoomController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.rooms.index');
Route::delete('admin/rooms/{room}', [AdminRoomController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.rooms.destroy');
Route::get('admin/rooms/create', [AdminRoomController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.rooms.create');
Route::post('admin/rooms', [AdminRoomController::class, 'store'])->middleware(['auth', 'verified'])->name('admin.rooms.store');
Route::get('admin/rooms/{room}/edit', [AdminRoomController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.rooms.edit');
Route::put('admin/rooms/{room}', [AdminRoomController::class, 'update'])->middleware(['auth', 'verified'])->name('admin.rooms.update');

/*Comentarios*/

Route::get('admin/comments', [AdminCommentController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.comments.index');
Route::delete('admin/comments/{comment}', [AdminCommentController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.comments.destroy');
Route::get('admin/comments/{comment}/edit', [AdminCommentController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.comments.edit');
Route::put('admin/comments/{comment}', [AdminCommentController::class, 'update'])->middleware(['auth', 'verified'])->name('admin.comments.update');

/*Reservaciones*/ 

Route::get('admin/bokkings', [AdminBokkingController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.bokkings.index');
Route::delete('admin/bokkings/{bokking}', [AdminBokkingController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.bokkings.destroy');

Route::get('admin/bokkings/{bokking}/edit', [AdminBokkingController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.bokkings.edit');
Route::put('admin/bokkings/{bokking}', [AdminBokkingController::class, 'update'])->middleware(['auth', 'verified'])->name('admin.bokkings.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
