<?php

declare(strict_types=1);

namespace App\UseCases\Product;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CreateAction
{
    /**
     * このファイルは商品登録の処理を記述する
     *
     * 
     */
    public function __invoke($validatedData)
    {
        DB::beginTransaction();

        try {
            // 登録処理の呼び出し
            $file_name = null;

            if(isset($validatedData['img_path'])){
            $image = $validatedData['img_path'];
            $file_name = $image->getClientOriginalName();
            $image->storeAs('public/images',$file_name);
            }

            Product::create(
                ['product_name' => $validatedData['product_name'],
                'img_path' => $file_name,
                'price' => $validatedData['price'],
                'stock' => $validatedData['stock'],
                'company_id' => $validatedData['company_id'],
                'comment' => $validatedData['comment'],
                ]);

            DB::commit();
            
            return ['success' => true];
        } catch (Exception $e) {
            DB::rollback();
            return ['success' => false, 'error' => $e->getMessage()]; // エラー情報を返す
        }
    }
}
