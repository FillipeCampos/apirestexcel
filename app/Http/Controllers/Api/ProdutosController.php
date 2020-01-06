<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use DB;
use Excel;
use App\Imports\ExcelImport;
use App\API\ApiError;


//require 'vendor/autoload.php';
class ProdutosController extends Controller
{
    private $produto;

    public function __construct(Produtos $produto)
    {
        $this->produto = $produto;
    }

    public function carregar_produtos()
    {
        $path = storage_path('app\products_teste_webdev_leroy.xlsx');
        $data = Excel::load($path)->get();

        (new ExcelImport)->queue($data);
        return back()->with('success', 'Dados Processados com sucesso!');
    }

    public function listar_produtos()
    {
        $data = ['data' => Produtos::all()];
        return response()->json($data);
    }

    public function show(Produtos $id)
    {
        $data = ['data' => $id];
        return response()->json($data);
    }

    public function atualizarProduto(Request $request, $id)
    {
        try {
           $produto = $this->produto->find($id);
           $produto->update($produto);

           $return = ['data' => ['msg' => 'Produto atualizado com sucesso!']];
           return response()->json($return, 201);

        } catch(\Exception $e) {
           if(config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
           }
        }

        return response()->json(ApiError::errorMessage('Houve um erro no processo de atualizar o item', 1010));
    }

    public function deletar_produto(Produtos $id)
    {
          try {
             $id->delete();
             return response()->json(['data' => ['msg' => 'Produto '.$id->name. ' removido com sucesso!']], 200);

          }  catch(\Exception $e) {
             if(config('app.debug')) {
                  return response()->json(ApiError::errorMessage($e->getMessage(), 1012));
             }

             return response()->json(ApiError::errorMessage('Houve um erro no processo de deletar o item', 1012));
          }


    }

}
