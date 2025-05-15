<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true; // 認証を有効にする場合、適切に設定
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'searchParams.product_name' => 'nullable|string',
            'searchParams.company_id' => 'nullable|integer',
            'searchParams.lowPrice' => 'nullable|integer',
            'searchParams.upperPrice' => 'nullable|integer',
            'searchParams.lowStock' => 'nullable|integer',
            'searchParams.upperStock' => 'nullable|integer',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            // バリデーションメッセージを追加するときはここに入れる
        ];
    }
}
