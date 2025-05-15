<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\ProductsSeeder; 
use Database\Seeders\CompaniesSeeder;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function setup(): void{

        parent::setUp(); // 親のsetupメソッドを必ず呼び出す

        // テストユーザーの作成
        $this->user = \App\Models\User::factory()->create();

    }

    /**
     * @test
     */
    public function index(): void
    {
        //setUp()で作成したユーザーで動作
        $this->actingAs($this->user);

        //productsテーブルとcompaniesテーブルののシーダーを呼び出す
        $this->seed(ProductsSeeder::class);
        $this->seed(CompaniesSeeder::class);
        
        //テストの対象ページ
        $response = $this->post('/api/products');

        //ページに正常にアクセスできているか確認
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function search(): void
    {
        //setUp()で作成したユーザーで動作
        $this->actingAs($this->user);

        //productsテーブルとcompaniesテーブルののシーダーを呼び出す
        $this->seed(ProductsSeeder::class);
        $this->seed(CompaniesSeeder::class);

        //テストの対象ページへ検索内容を送信
        $response = $this->post('/api/products/search',[
            'searchParams' =>[
            'product_name' =>'ジュース',
            'company_id' =>'1',
            'lowPrice' =>100,
            'upperPrice' =>500,
            'lowStock' =>100,
            'upperStock' =>500,
            ]
        ]);

        //ページに正常にアクセスできているか確認
        $response->assertStatus(200);
        
        //テストの対象ページへ商品名の検索内容を送信
        $response->assertJsonFragment(['product_name' => 'ジュース']);
        //テストの対象ページへ会社のIDの検索内容を送信
        $response->assertJsonFragment(['company_id' =>'1']);

        //下限上限の確認の仕方分からないので一旦上記と同様確認
        //テストの対象ページへ金額の検索内容を送信
        // $response->assertJsonFragment(['price' =>100]);
        // $response->assertJsonFragment(['price' =>500]);
        // //テストの対象ページへ会社のIDの検索内容を送信
        // $response->assertJsonFragment(['stock' =>100]);
        // $response->assertJsonFragment(['stock' =>500]);
    
    }
    
}
