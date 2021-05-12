<?php

namespace App\Http\Repository\StockRecord;

interface StockRecordInterface
{
    public function all();
    public function get($id);
    public function count();
    public function paginate($id);
}
