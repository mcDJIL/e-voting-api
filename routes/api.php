<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KotasController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PemiluPresidenController;
use App\Http\Controllers\Admin\ProvinsiesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberPresiden;
use App\Http\Middleware\TokenAdminValidation;
use App\Http\Middleware\TokenMemberValidation;
use App\Models\PemiluPresiden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::controller(AdminController::class)->group(function() {
    Route::post('admin/login', [AdminController::class, 'login']);
    Route::post('admin/logout', [AdminController::class, 'logout']);
});

Route::resource('provinsi', ProvinsiesController::class);
Route::resource('kota', KotasController::class);
Route::resource('pemilu-presiden', PemiluPresidenController::class);

Route::middleware(TokenAdminValidation::class)->group(function() {
    Route::resource('member', MemberController::class);
    Route::put('member/ban/{id}', [MemberController::class, 'banMember']);

    Route::put('pemilu-presiden/stop', [PemiluPresidenController::class, 'update']);
    
});

Route::controller(MemberPresiden::class)->group(function() {
    Route::post('presiden', [MemberPresiden::class, 'store']);
    Route::get('presiden/member', [MemberPresiden::class, 'show']);
    Route::get('presiden', [MemberPresiden::class, 'index']);
    Route::get('presiden/count', [MemberPresiden::class, 'realCount']);
});

Route::controller(AuthController::class)->group(function() {
    Route::post('auth/register', 'register');
    Route::post('auth/login', 'login');
    Route::post('auth/logout', 'logout');
    Route::put('auth/update-profile', 'updateProfile');
    Route::get('auth/me', 'me');
});