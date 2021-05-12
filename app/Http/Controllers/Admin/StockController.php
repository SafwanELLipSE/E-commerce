<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Product\ProductInterface;
use App\Http\Repository\Stock\StockInterface;

class StockController extends Controller
{
    public function __construct(ProductInterface $productRepository, StockInterface $stockRepository)
    {
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
    }
    public function Index(Request $request)
    {
        return view('backend.stocks.stock_index', [
            'products' => $this->productRepository->all(),
        ]);
    }
    public function storeStock(Request $request)
    {
        $this->stockRepository->store($request);
        return redirect()->back();
    }
    public function displayAllStock(Request $request){
        return view('backend.stocks.stock_list');
    }
    public function allStockList(Request $request)
    {
        echo json_encode($this->stockRepository->list($request));
    }
    public function reStockStock(Request $request)
    {
        $id = $request->post('stock_id');
        $this->stockRepository->restock($request, $id);
        return redirect()->back();
    }
    public function inStock(Request $request)
    {
        $id = $request->post('stock_id');
        $this->stockRepository->stockIn($request, $id);
        return redirect()->back();
    }
    public function outStock(Request $request)
    {
        $id = $request->post('stock_id');
        $this->stockRepository->stockOut($request, $id);
        return redirect()->back();
    }
    public function updateStock(Request $request)
    {
        $id = $request->post('stock_id');
        $this->stockRepository->update($request, $id);
        return redirect()->back();
    }
    public function destroyStock(Request $request)
    {
        $this->stockRepository->delete($request, $request->post('id'));
        return response()->json("Successfully, Stock has been deleted", 200);
    }
}
