<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('API')->name('api.')->group(function() {
   Route::prefix('produtos')->group(function() {
     Route::get('/carregar_produtos', 'ProdutosController@carregar_produtos')->name('carregar_produtos');
     Route::get('/listar_produtos', 'ProdutosController@listar_produtos')->name('listar_produtos');
     Route::get('/{id}', 'ProdutosController@show')->name('procurar_produto');

     Route::put('/{id}', 'ProdutosController@atualizarProduto')->name('atualizarProduto');
     Route::delete('/{id}', 'ProdutosController@deletar_produto')->name('deletar_produto');
   });
});
