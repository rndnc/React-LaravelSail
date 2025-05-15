<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
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
          // 他のパラメータに対するバリデーションルールを追加
          'product_name' => 'required|string',
          'img_path' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg',
          'price' => 'required|integer',
          'stock' => 'required|integer',
          'company_id' => 'required|integer',
          'comment' => 'max:150',
        ];
    }
        /**
     * 項目名
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'product_name' => '商品名',
            'price' => '価格',
            'stock' => '在庫数',
            'company_id' => 'メーカー名',
            'comment' => 'コメント',
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
            'product_name.required' => ':attributeは必須項目です。',
            'price.required' => ':attributeは必須項目です。',
            'price.integer' => ':attributeは数字を入れてください。',
            'stock.required' => ':attributeは必須項目です。',
            'stock.integer' => ':attributeは数字を入れてください。',
            'company_id.required' => ':attributeは必須項目です。',
            'comment.max' => ':attributeは:max字以内で入力してください。',
        ];
    }
    protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(response()->json([
        'errors' => $validator->errors()
    ], 422));
}
}
