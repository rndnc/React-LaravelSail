<?php

declare(strict_types=1);

namespace App\UseCases\Product;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Collection;

class SearchAction
{
    /**
     * このファイルは商品一覧画面を開く処理を記述する
     *
     * @return Collection
     */
    public function __invoke($validatedData): Collection
    {
        $query = Product::query()->with('company'); 
        
        $query = $this->ProductNameFilter($query,$validatedData['searchParams']);
        $query = $this->CompanyIdFilter($query,$validatedData['searchParams']);
        $query = $this->PriceFilter($query,$validatedData['searchParams']);
        $query = $this->StockFilter($query,$validatedData['searchParams']);
        $product = $query->get();

        $companies = Company::all();     
        return collect(['product' => $product, 'companies' => $companies]);
    }

    // 商品名の検索処理
    protected function ProductNameFilter($query,array $data){
        if(!empty($data['product_name'])) {
            $query->where('product_name', 'LIKE', "%{$data['product_name']}%");
        }
        return $query;
    }

    // メーカー名の検索処理    
    protected function CompanyIdFilter($query,array $data){
        if(!empty($data['company_id'])) {
            $query->where('company_id', '=', $data['company_id']);
        }
        return $query;
    }

    // 価格の検索処理    
    protected function PriceFilter($query,array $data){
        if(!empty($data['lowPrice']) && empty($data['upperPrice'])) {
            $query->where('price', '>=', $data['lowPrice']);
        } else if (empty($data['lowPrice']) && !empty($data['upperPrice'])) {
            $query->where('price', '<=', $data['upperPrice']);
        } else if (!empty($data['lowPrice']) && !empty($data['upperPrice'])){
            $query->whereBetween('price', [$data['lowPrice'], $data['upperPrice']]);
        }
        return $query;
    }

     // 在庫の検索処理    
    protected function StockFilter($query,array $data){
        if(!empty($data['lowStock']) && empty($data['upperStock'])) {
            $query->where('stock', '>=', $data['lowStock']);
        } else if (empty($data['lowStock']) && !empty($data['upperStock'])) {
            $query->where('stock', '<=', $data['upperStock']);
        } else if (!empty($data['lowStock']) && !empty($data['upperStock'])){
            $query->whereBetween('stock', [$data['lowStock'],$data['upperStock']]);
        }
        return $query;
    }
    
}
