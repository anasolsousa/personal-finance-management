<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('admin/login', [AuthController::class, 'loginAdmin']);
    Route::post('user/login', [AuthController::class, 'loginUser']);
    Route::post('user/register', [AuthController::class, 'register']);
    
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::post('admin/logout', [AuthController::class, 'logout']);
        Route::get('/adminProfiles', [AuthController::class, 'adminProfile']);

        // Outras rotas protegidas para admin

        Route::get('/categories', [CategoryController::class, 'index']); // lista categoria
        Route::post('/categories', [CategoryController::class, 'store']); // criar categorias 
        Route::patch('/categories/{id}', [CategoryController::class, 'updateCategory']); // atualizar categoria
        Route::delete('/categories/{id}', [CategoryController::class, 'destroyCategory']); // apagar categoria

        Route::patch('/subcategories/{id}', [CategoryController::class, 'updateSubCategory']); // atualizar subcategoria
        Route::get('/subcategories', [CategoryController::class, 'subCategory']); // lista das subcategorias
        Route::delete('/subcategories/{id}', [CategoryController::class, 'destroySubCategory']); // apagar sucategoria
        Route::post('/subcategories', [CategoryController::class, 'storeSubCategory']); // criar categorias 
    
        // entity
        Route::post('/entities', [EntityController::class, 'store']); // criar entidades
        Route::get('/entities', [EntityController::class, 'index']); // lista entidades
        Route::patch('/entities/{id}', [EntityController::class, 'update']); // lista entidades
        Route::delete('/entities/{id}', [EntityController::class, 'destroy']); // apagar entidades

        // subentity
        Route::get('/subEntity', [EntityController::class, 'indexSubEntity']); // listagem entidades
        Route::post('/subEntity', [EntityController::class, 'storeSubEntity']); // criar entidades
        Route::patch('/subEntity/{id}', [EntityController::class, 'updateSubEntity']); // criar entidades
        Route::delete('/subEntity/{id}', [EntityController::class, 'destroySubEntity']); // criar entidades
  
    });
    
    Route::group(['middleware' => 'auth:user'], function () {
        Route::post('user/logout', [AuthController::class, 'logout']);
        // Outras rotas protegidas para users

        Route::get('/category', [CategoryController::class, 'categoryAndSubCategory']); // lista categorias
        Route::get('/entity', [EntityController::class, 'entityAndSubEntity']); // lista entidades
        Route::get('/userProfiles', [AuthController::class, 'userProfile']);

        // conta de MB
        Route::get('/account', [AccountController::class, 'index']);
        Route::post('/account', [AccountController::class, 'store']);
        Route::patch('/account/{id}', [AccountController::class, 'update']);
        Route::delete('/account/{id}', [AccountController::class, 'destroy']);

        // Transações - entrada e saida de dinheiro
        Route::get('/transaction', [TransactionController::class, 'index']); // lista transações
        Route::post('/transaction', [TransactionController::class, 'store']); // criar transação 
    
        Route::patch('/transaction', [TransactionController::class, 'show']); // ver uma determinada transação categorias 
        Route::patch('/transaction/{id}', [TransactionController::class, 'update']); // atualizar transação
        Route::delete('/transaction/{id}', [TransactionController::class, 'destroy']); // eliminar transação

    });
});




