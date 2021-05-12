<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Stock_record extends Model
{
    const CREATE_STOCK = 0;
    const WITHDRAW_STOCK = 1;
    const STOCK_IN = 2;
    const OUT_OF_STOCK = 3;
    const RE_STOCK = 4;
    const EDIT_STOCK = 5;

    protected $table = 'stock_records';
    public function stock()
    {
        return $this->hasOne(Stock::class, 'id', 'stock_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    public static function getStatus($active_id)
    {
        switch ($active_id) {
            case 0:
                return "Created";
            case 1:
                return "Withdraw";
            case 2:
                return "Stock In";
            case 3:
                return "Stock Out";
            case 4:
                return "Restock";
            case 5:
                return "Edited";
        }
    }
}
