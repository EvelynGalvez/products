<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'category',
        'description',
        'amount',
        'price',
        'branch_id'
    ];

    public static function search($input)
    {
        $product = new self();
        if (isset($input['code'])){
            $product = $product->where('code', $input['code']);
        }

        if (isset($input['name'])){
            $product = $product->where('name', $input['name']);
        }


        return $product->get();
    }

}
