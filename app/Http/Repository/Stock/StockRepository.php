<?php

namespace App\Http\Repository\Stock;

use App\Models\Stock;
use App\Models\Stock_record;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class StockRepository implements StockInterface
{
    public function all()
    {
        return Stock::all();
    }
    public function get($id)
    {
        return Stock::find($id);
    }
    public function count(){}
    public function store($request)
    {
        $validator = Validator::make($request->all(), [
            'product' => 'required',
            'color' => 'required',
            'size' => 'required',
            'stock_in'   => 'required|numeric',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $uniqueProduct = Stock::where('product_id', $request->post('product'))
                                ->where('color_id', $request->post('color'))
                                ->where('size_id', $request->post('size'))
                                ->count();
                                
        if($uniqueProduct == 0){
            $stock = new Stock;
            $stock->product_id = $request->post('product');
            $stock->color_id = $request->post('color');
            $stock->size_id = $request->post('size');
            $this->saveStock($stock, $request->post('stock_in'), 0, 0, Stock::No_PREVIOUS_HISTORY);
            $stock->created_by = Auth::user()->id;
            $stock->save();

            $record = new Stock_record;
            $this->saveRecord($record, $stock->id, $request->post('stock_in'), 0, 0, 0, Stock_record::CREATE_STOCK);
            $record->save();
            Alert::success('Success', 'Successfully Created a new Stock');
        }else{
            Alert::warning('Warning', 'The Product is already added Stock. Please, Try to Update.');
        }
    }
    public function list($request)
    {
        $stocks = $this->all();

        $totalData = $stocks->count();
        $totalFiltered = $totalData;
        $toReturn = array();
        $count = 1;
        foreach ($stocks as $stock) {
            $show = route('utilize.stockRecord.view', $stock->id);
            $localArray[0] = $count++;
            $localArray[1] = $stock->product->name;
            $localArray[2] = $stock->color->name;
            $localArray[3] = $stock->size->measurement;
            $localArray[4] = $stock->current_stock;
            $localArray[5] = $stock->stock_in;
            $localArray[6] = $stock->restock;
            $localArray[7] = Stock::getStatus($stock->status);
            $localArray[8] = $stock->created_at->format('d.m.Y');
            $localArray[9] = "<div class='btn-group'>
                    <a href='{$show}' class='btn btn-sm btn-primary'> View</a>
                    <button type='button' class='btn btn-sm btn-primary dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item' data-stockid='{$stock->id}' data-toggle='modal' data-target='#modal-In'><i class='fas fa-cart-plus'></i> Stock In</a>
                        <a class='dropdown-item' data-stockid='{$stock->id}' data-toggle='modal' data-target='#modal-Out'><i class='fas fa-cart-arrow-down'></i> Stock Out</a>
                        <a class='dropdown-item' data-stockid='{$stock->id}' data-toggle='modal' data-target='#modal-reStock'><i class='fas fa-history'></i> Re-Stock</a>
                        <a class='dropdown-item' data-stockid='{$stock->id}' data-toggle='modal' data-target='#modal-Edit'><i class='far fa-edit'></i> Edit</a>
                        <a class='dropdown-item' id='delete-stock' data-stock-id='{$stock->id}'><i class='far fa-trash-alt'></i> Delete</a>
                    </div>
                </div>";
            $toReturn[] = $localArray;
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $toReturn
        );
        return $json_data;
    }
    public function restock($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'stock_id'=> 'required|exists:stocks,id',
            'restock' =>'required|numeric',
            ]);
        if($validator->fails()) {
            alert()->warning('Error occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $reSupply = $this->get($id)->current_stock + $request->post('restock');

        $stock = $this->get($id);
        $this->saveStock($stock, $reSupply, 0, $request->post('restock'), Stock::No_PREVIOUS_HISTORY);
        $stock->save();

        $record = new Stock_record;
        $this->saveRecord($record, $stock->id, $reSupply, 0, 0, $request->post('restock'),Stock_record::RE_STOCK);
        $record->created_by = Auth::user()->id;
        $record->save();

        Alert::success('Success', 'Successfully, Stock has been Re-supplied');
    }
    public function stockIn($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'stock_id' => 'required|exists:stocks,id',
            'in_stock' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $inStock = $this->get($id)->current_stock - ($request->post('in_stock') + $this->get($id)->stock_in);

        if($inStock >= 0){
            $stock = $this->get($id);
            $this->saveStock($stock, $inStock, $request->post('in_stock'), $this->get($id)->restock, Stock::STOCK_IN);
            $stock->save();

            $record = new Stock_record;
            $this->saveRecord($record, $stock->id, $inStock, $request->post('in_stock'), 0, 0, Stock_record::STOCK_IN);
            $record->created_by = Auth::user()->id;
            $record->save();

            Alert::success('Success', 'Successfully, Stock has been Stock-In');
        }else{
            Alert::warning('Warning', 'Stock can\'t be taken more than '.$this->get($id)->current_stock.'. Please, Try to Update.');
        }
    }
    public function stockOut($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'stock_id' => 'required|exists:stocks,id',
            'out_stock' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $outStock = $this->get($id)->stock_in - $request->post('out_stock');
        $currentStock = $this->get($id)->current_stock + $request->post('out_stock');
        
        if ($outStock >= 0) {
            $stock = $this->get($id);
            $this->saveStock($stock, $currentStock, $outStock, $this->get($id)->restock, Stock::STOCK_OUT);
            $stock->save();

            $record = new Stock_record;
            $this->saveRecord($record, $stock->id, $outStock, 0, $request->post('out_stock'), 0, Stock_record::OUT_OF_STOCK);
            $record->created_by = Auth::user()->id;
            $record->save();

            Alert::success('Success', 'Successfully, Stock has been Stock-Out');
        } else {
            Alert::warning('Warning', 'Stock can\'t be taken more than ' . $this->get($id)->stock_in . '. Please, Try to Update.');
        }
    }
    public function update($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'stock_id' => 'required|exists:stocks,id',
            'edit_stock' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
        if ($request->post('edit_stock') >= 0) {
            $stock = $this->get($id);
            $this->saveStock($stock, $request->post('edit_stock'), 0, 0, Stock::No_PREVIOUS_HISTORY);
            $stock->save();

            $record = new Stock_record;
            $this->saveRecord($record, $stock->id, $request->post('edit_stock'), 0, 0, 0, Stock_record::EDIT_STOCK);
            $record->created_by = Auth::user()->id;
            $record->save();

            Alert::success('Success', 'Successfully, Stock has been Stock-Out');
        } else {
            Alert::warning('Warning', 'Stock is not valid, '.$request->post('edit_stock').'. Please, Try to Update.');
        }
    }
    public function delete($request, $id){
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:stocks,id',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);

        $record = Stock_record::where('stock_id', $id)->delete();
        $stock = $this->get($id);
        $stock->delete();
    }
    private function saveStock($data, $current, $in, $restock, $status)
    {
        $data->current_stock = $current;
        $data->stock_in = $in;
        $data->restock = $restock;
        $data->status = $status;
    }
    private function saveRecord($data, $stock, $current, $in, $out, $restock, $status)
    {
        $data->stock_id = $stock;
        $data->current_stock = $current;
        $data->stock_in = $in;
        $data->stock_out = $out;
        $data->restock = $restock;
        $data->status = $status;
        $data->created_by = Auth::user()->id;
    }
}
