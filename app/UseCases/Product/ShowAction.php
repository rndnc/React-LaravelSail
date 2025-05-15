<?php

declare(strict_types=1);

namespace App\UseCases\Product;

use App\Models\Product;


class ShowAction
{
    /**
     * このファイルは詳細画面を開く処理を記述する
     *
     * @return Collection
     * @return Product|null
     */
    public function __invoke(int $id)
    {
        $product = Product::with('company')->find($id);
        return $product;
    }
}
