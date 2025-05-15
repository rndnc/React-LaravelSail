<?php

declare(strict_types=1);

namespace App\UseCases\Product;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Collection;

class IndexAction
{
    /**
     * このファイルは商品一覧画面を開く処理を記述する
     *
     * @return Collection
     */
    public function __invoke(): Collection
    {
        $product = Product::with('company')->get();
        $companies = Company::all();
 
        return collect(['product' => $product, 'companies' => $companies]);
    }
}
