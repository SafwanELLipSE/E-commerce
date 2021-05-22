<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discount';

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
