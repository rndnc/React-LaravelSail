<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'img_path',

        'price',
        'stock',
        'company_id',
        'comment'
    ];

    public function company() {
        // Company モデルに属する
        return $this->belongsTo(Company::class,'company_id'); 

    }

}
