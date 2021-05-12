<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Stock\StockInterface;
use App\Http\Repository\StockRecord\StockRecordInterface;

class StockRecordController extends Controller
{
    public function __construct(StockRecordInterface $stockRecordRepository, StockInterface $stockRepository)
    {
        $this->stockRecordRepository = $stockRecordRepository;
        $this->stockRepository = $stockRepository;
    }
    public function displayAllStockRecord(Request $request, $id)
    {
        return view('backend.stocks.stock_record_display', [
            'stock' => $this->stockRepository->get($id),
            'records' => $this->stockRecordRepository->paginate($id),
        ]);
    }
}
