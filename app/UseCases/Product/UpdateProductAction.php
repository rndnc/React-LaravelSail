<?php

declare(strict_types=1);

namespace App\UseCases\Product;

use App\Models\Product;
use App\Models\Company;

class UpdateProductAction
{
    /**
     * このファイルは詳細画面を開く処理を記述する
     *
     * @return Product|null
     */
    public function __invoke(int $id)
    {
        $product = Product::with('company')->find($id);
        $companies = Company::select('id', 'company_name')->get();

        return (['product' => $product, 'companies' => $companies]);

    }
}
