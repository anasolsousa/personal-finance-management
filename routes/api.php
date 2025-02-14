<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('admin/login', [AuthController::class, 'loginAdmin']);
    Route::post('user/login', [AuthController::class, 'loginUser']);
    Route::post('user/register', [AuthController::class, 'register']);
    
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::post('admin/logout', [AuthController::class, 'logout']);
        // Outras rotas protegidas para admin

        Route::get('/categories', [CategoryController::class, 'index']); // lista categoria
        Route::post('/categories', [CategoryController::class, 'store']); // criar categorias 
        Route::patch('/categories/{id}', [CategoryController::class, 'updateCategory']); // atualizar categoria
        Route::delete('/categories/{id}', [CategoryController::class, 'destroyCategory']); // apagar categoria

        Route::patch('/subCategory/{id}', [CategoryController::class, 'updateSubCategory']); // atualizar subcategoria
        Route::get('/subCategory', [CategoryController::class, 'subCategory']); // lista das subcategorias
        Route::delete('/subCategory/{id}', [CategoryController::class, 'destroySubCategory']); // apagar sucategoria
        Route::post('/subCategory', [CategoryController::class, 'storeSubCategory']); // criar categorias 
    });
    
    Route::group(['middleware' => 'auth:user'], function () {
        Route::post('user/logout', [AuthController::class, 'logout']);
        // Outras rotas protegidas para users

        Route::get('/category', [CategoryController::class, 'categoryAndSubCategory']); // lista categorias

    });
});




