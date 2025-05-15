<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log; // Logクラスのインポート


class ProductListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request){
        $id = (int) $id;

        $model = new Products();
        $product = $model->ProductDetail($id);
        Log::info($product);
    
        return response()->json(['product' => $product]);
        
    }

}
