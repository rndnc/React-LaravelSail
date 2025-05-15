<?php

declare(strict_types=1); // 型の厳密を行うので各ファイルに記述する

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UseCases\Product\IndexAction;
use App\Http\Requests\Product\IndexRequest;
use App\UseCases\Product\SearchAction;
use App\Http\Requests\Product\SearchRequest;
use App\UseCases\Product\ShowAction;
use App\Http\Requests\Product\ShowRequest;
use App\UseCases\Product\CreateAction;
use App\Http\Requests\Product\CreateRequest;
use App\UseCases\Product\GetCompanyAction;
use App\Http\Requests\Product\GetCompanyRequest;
use App\UseCases\Product\UpdateProductAction;
use App\Http\Requests\Product\UpdateProductRequest;
use App\UseCases\Product\UpdateAction;
use App\Http\Requests\Product\UpdateRequest;
use App\UseCases\Product\DeleteAction;
use App\Http\Requests\Product\DeleteRequest;

class ProductController extends Controller
{
    // このクラスで、index,show,create,update,deleteをまとめる

    /**
     * 商品一覧画面を表示する
     *
     * @param IndexRequest $request
     * @param IndexAction $indexAction
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexRequest $request, IndexAction $indexAction)
    {
        // ここでバリデーションとIndexActionを実行してデータを取得
        $data = $indexAction($request->validated());
        // データをJSONレスポンスとして返す
        return response()->json($data);
    }

    /**
     * 商品検索機能
     *
     * @param SearchRequest $request
     * @param SearchAction $searchAction
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(SearchRequest $request, SearchAction $searchAction)
    {
        // ここでバリデーションとIndexActionを実行してデータを取得
        $validatedData =$request->validated();
        $data = $searchAction($validatedData);
        return response()->json($data);
    }


    /**
     * メーカー情報を取得する
     *@param GetCompanyAction $getCompanyAction
     *@return \Illuminate\Http\JsonResponse


     */
    public function getCompany(GetCompanyRequest $request ,GetCompanyAction $getCompanyAction)
    {
        $companies = $getCompanyAction($request->validated());
        // データをJSONレスポンスとして返す
        return response()->json($companies);

    }

        /**
     * 詳細画面を表示する
     *@param int $id
     *@param ShowAction $showAction
     *@return \Illuminate\Http\JsonResponse

     */
    public function show($id,Request $request,ShowAction $showAction)
    {
        //idを整数として渡す
        $product = $showAction((int) $id);
        // データをJSONレスポンスとして返す
        return response()->json($product);

    }

    /**
     *商品登録を行う
     * @param CreateAction $CreateAction
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateRequest $request,CreateAction $createAction)
    {
        $validatedData =$request->validated();
        $product = $createAction($validatedData);
        
        if($product['success']){
            return response()->json(['message' => 'Product created successfully.'], 200);
        } else {
            return response()->json(['errors' => 'Failed to create product.'], 400);
        }
    }

    /**
     *更新をするデータの情報を取得
     *@param UpdateProductAction $updateProductAction
     *@return \Illuminate\Http\JsonResponse
     */ 
    public function updateProduct($id,UpdateProductRequest $request,UpdateProductAction $updateProductAction)
    {
        //idを整数として渡す
        $data = $updateProductAction((int) $id);
        // データをJSONレスポンスとして返す
        return response()->json($data);
    }


    /**
     * 更新処理を行う
     *@param UpdateAction $updateAction
     *@return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request,UpdateAction $updateAction,$id)
    {
        $validatedData =$request->validated();
        $product = $updateAction((int) $id,$validatedData);
        
        if($product['success']){
            return response()->json(['message' => 'Product created successfully.'], 200);
        } else {
            return response()->json(['errors' => 'Failed to create product.'], 400);
        }
    }

        /**
     * 削除処理を行う
     *@param DeleteAction $updateAction
     *@return \Illuminate\Http\JsonResponse
     */
    public function delete($id,DeleteAction $deleteAction)
    {
        $product = $deleteAction((int) $id);
        
        if($product['success']){
            return response()->json(['message' => 'Product deleted successfully.'], 200);
        } else {
            return response()->json(['errors' => 'Failed to delete product.'], 400);
        }
    }

}
