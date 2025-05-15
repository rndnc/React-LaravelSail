<?php

declare(strict_types=1);

namespace App\UseCases\Product;

use App\Models\Company;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GetCompanyAction
{
    /**
     * このファイルは会社名の取得処理を記述する
     *
     * @return Collection
     */
    public function __invoke()
    {
        return $companies = Company::select('id', 'company_name')->get();
    }
}
