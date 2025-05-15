<?php

declare(strict_types=1);

namespace App\UseCases\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class UpdateAction
{
    /**
     * このファイルは詳細画面を開く処理を記述する
     *
     * @return Collection
     * @return Product|null
     */
    public function __invoke(int $id,$validatedData)
    {
        DB::beginTransaction();

        try {
            //更新するデータを取得
            $product = Product::find($id);

            // 元の画像のパスを設定
            $file_name = $product->img_path;
            // 新しいくアップロードされたら上書き
            if(isset($validatedData['img_path'])){
            $image = $validatedData['img_path'];
            $file_name = $image->getClientOriginalName();
            $image->storeAs('public/images',$file_name);
            }

            // 更新処理
            $product->update([
                'product_name' => $validatedData['product_name'],
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
