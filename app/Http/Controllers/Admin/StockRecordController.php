<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Stock\StockInterface;
use App\Http\Repository\StockRecord\StockRecordInterface;
use App\Exports\Stock_record_export;
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
    public function excelReport(Request $request, $id)
    {   
        return (new Stock_record_export($id))->download('record_stock_' . $id . '.xlsx');;
    }
}
