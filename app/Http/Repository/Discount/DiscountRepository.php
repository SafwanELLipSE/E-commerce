<?php

namespace App\Http\Repository\Discount;

use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class DiscountRepository implements DiscountInterface
{
    public function all()
    {
        return Discount::all();
    }
    public function get($id)
    {
        return Discount::find($id);
    }
    public function store($request)
    {
        $validator = $this->validationDiscount($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $product = Product::find($request->post('product'));

        $uniqueProduct = Discount::where('product_id', $request->post('product'))->count();
        if($uniqueProduct == 0){
            $discount = new Discount;
            $this->saveInformation($discount, ($product->selling_price * $request->post('percentage'))/100, $request);
            $product->discount_status = Product::DISCOUNT_AVAILABLE;
            $product->save();
            $discount->created_by = Auth::user()->id;
            $discount->save();
            Alert::success('Success', 'Successfully Created a new Discount.');
        }else{
            Alert::warning('Warning', 'The Product is already added in Discount List. Please, Try to Update.');
        }
    }
    public function count(){}
    public function list($request){
        $discounts = $this->all();

        $totalData = $discounts->count();
        $totalFiltered = $totalData;
        $toReturn = array();
        $count = 1;
        foreach ($discounts as $discount) {
            $show = route('customize.discount.edit', $discount->id);
            $localArray[0] = $count++;
            $localArray[1] = isset($discount->product->name) ? $discount->product->name : 'No Longer Available';
            $localArray[2] = $discount->percentage;
            $localArray[3] = $discount->current_amount;
            $localArray[4] = date('d.m.Y', strtotime($discount->start_date));
            $localArray[5] = date('d.m.Y', strtotime($discount->end_date));
            $localArray[6] = Auth::User($discount->created_by)->name;
            $localArray[7] = $discount->created_at->format('d.m.Y');
            $localArray[8] = "<a href='{$show}' class='btn btn-sm btn-info'><i class='fas fa-user-edit'></i></a> 
                            <a class='btn btn-sm btn-danger' id='delete-discount' data-discount-id='{$discount->id}'><i class='fas fa-trash-alt'></i></a>";
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
    public function update($request, $id){
        $validator = $this->validationDiscount($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $product = Product::find($request->post('product'));

        $discount = $this->get($id);
        $this->saveInformation($discount, ($product->selling_price * $request->post('percentage')) / 100, $request);
        $discount->save();
        Alert::success('Success', 'Successfully Discount information has been updated.');
    }
    public function delete($request, $id){
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:discount,id',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);

        $discount = $this->get($id);
        $discount->delete();
    }
    private function validationDiscount($request)
    {
        return  Validator::make($request->all(), [
            'product'   => 'required|',
            'start_date' => 'required|after:yesterday',
            'end_date'   => 'required|after:start_date',
            'percentage' => 'required|numeric',
        ]);
    }
    private function saveInformation($data, $price, $request)
    {
        $data->product_id = $request->post('product');
        $data->start_date = date('Y-m-d',strtotime($request->post('start_date')));
        $data->end_date = date('Y-m-d',strtotime($request->post('end_date')));
        $data->current_amount = $price;
        $data->percentage = $request->post('percentage');
    }
}
