<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'category',
        'description',
        'amount',
        'price',
        'branch_id',
        'branch_name'
    ];

    public static function search($input, $deleted = false)
    {
        $product = new self();

        if($deleted){
            $product = $product->onlyTrashed();
        } else {
            if (isset($input['code'])){
                $product = $product->where('code', $input['code']);
            }

            if (isset($input['name'])){
                $product = $product->where('name', $input['name']);
            }

            if (isset($input['branch_id'])){
                $product = $product->where('branch_id', $input['branch_id']);
            }

        }

        return $product->get();
    }

    public static function destroyByFilters($input, $deleteType)
    {
        $product = new self();

        if (isset($input['branch_id'])) {
            $product = $product->where('branch_id', $input['branch_id']);
        }

        if (isset($input['code'])) {
            $product = $product->where('code', $input['code']);
        }

        //dd($product->toSql());


        //0: borrado lógico    1: borrado físico
        if($deleteType == 0){
            if(count($input) > 0){
                return $product->delete();
            }
            return $product->query()->delete();
        }

        if($deleteType == 1){
            if(count($input) > 0){
                return $product->forceDelete();
            }
            return $product->query()->forceDelete();

            return $product->forceDelete();
        }

    }

}
