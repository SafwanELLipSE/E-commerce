<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Stock extends Model
{
    const No_PREVIOUS_HISTORY = 0;
    const STOCK_IN = 1;
    const STOCK_OUT = 2;
    protected $table = 'stocks';

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function size()
    {
        return $this->hasOne(Size::class, 'id', 'size_id');
    }
    public function color()
    {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    public static function getStatus($active_id)
    {
        switch ($active_id) {
            case 0:
                return "No Record";
            case 1:
                return "Stock In";
            case 2:
                return "Stock Out";
        }
    }
}
