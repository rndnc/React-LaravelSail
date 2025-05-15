<?php

declare(strict_types=1);

namespace App\UseCases\Product;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DeleteAction
{
    /**
     * このファイルは商品登録の処理を記述する
     *
     * 
     */
    public function __invoke($id)
    {
        DB::beginTransaction();

        try{
            $product = Product::find($id);
            if (!$product) {
                DB::rollBack();
                return ['success' => false, 'message' => 'Product not found'];  // 商品が見つからない場合、ここでリターン
            }

            $product->delete();
            DB::commit();
            return ['success' => true];
        } catch (\Exception $e) {
            DB::rollBack();

            return ['success' => false, 'error' => $e->getMessage()]; // エラー情報を返
        }
    }
}
