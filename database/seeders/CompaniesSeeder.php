<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create('ja_JP');

        $companyNames = [
            'コカ・コーラ',
            'サントリー',
            '伊藤園',
            'キリン',
            'アサヒ'
        ];

        foreach ($companyNames as $companyName) {
            DB::table('companies')->insert([
                'company_name'=> $companyName,
                'street_address'=> $faker->address(),
                'reprentative_name'=> $faker->name(),
            ]);
        }
        
    }
}
