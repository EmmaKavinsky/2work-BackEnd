<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\DemandeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/user/register', [AuthController::class, 'register'])->name('user.register');
Route::post('user/login', [AuthController::class, 'login'])->name('user.login');
Route::get('user/getUsers',[AuthController::class,'getUsers'])->name('user.getUsers');
Route::post('annonce/get', [AnnonceController::class, 'getAnnonces'])->name('user.getAnnonces');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('update-profile', [AuthController::class, 'updateProfile'])->name('user.updateProfile');
    Route::post('update-password', [AuthController::class, 'updatePassword'])->name('user.updatePassword');
    Route::post('annonce/create', [AnnonceController::class, 'createAnnonce'])->name('user.createAnnonce');
    Route::post('annonce/user-get', [AnnonceController::class, 'userAnnonces'])->name('user.userAnnonces');
    Route::post('annonce/get/{annonce}', [AnnonceController::class, 'getAnnonce'])->name('user.getAnnonce');

    Route::post('annonce/update/{annonce}', [AnnonceController::class, 'updateAnnonce'])->name('user.updateAnnonce');
    Route::post('annonce/delete/{annonce}', [AnnonceController::class, 'deleteAnnonce'])->name('user.deleteAnnonce');

    Route::post('demande/create', [DemandeController::class, 'createDemande'])->name('user.createDemande');
    Route::post('demande/get', [DemandeController::class, 'getDemandes'])->name('user.getDemandes');
    Route::post('demande/user-get', [DemandeController::class, 'userDemandes'])->name('user.userDemandes');

});
