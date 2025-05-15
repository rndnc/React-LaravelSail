<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create('ja_JP');

        $productNames = [
            '天然水', 'ジュース', 'スポーツドリンク', 'エナジードリンク', '緑茶', '紅茶'
        ];

        for ($i = 0; $i < 20; $i++) {
            DB::table('products')->insert([
                'img_path'=>$faker->imageUrl(),
                'product_name'=> $faker->randomElement($productNames),
                'price'=> $faker->numberBetween(100, 300),
                'stock'=> $faker->numberBetween(0, 500),
                'company_id'=>$faker->numberBetween(1, 5),
                'comment'=> $faker->sentence(),
            ]);
        }
    }
}
