<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    public static function search($input)
    {
        $branch = new self();
        if (isset($input['name'])){
            $branch = $branch->where('name', $input['name']);
        }

        return $branch->get();
    }
}
