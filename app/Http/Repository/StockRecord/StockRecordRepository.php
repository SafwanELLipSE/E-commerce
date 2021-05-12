<?php

namespace App\Http\Repository\StockRecord;

use App\Models\Stock_record;

class StockRecordRepository implements StockRecordInterface
{
    public function all()
    {
        return Stock_record::all();
    }
    public function get($id)
    {
        return Stock_record::find($id);
    }
    public function paginate($id)
    {
        return Stock_record::where('stock_id', $id)->paginate(15);
    }
    public function count(){

    }
}
