<?php

namespace App\Http\Repository\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class ProductRepository implements ProductInterface
{
    public function all(){
        return Product::all();
    }
    public function get($id){
        return Product::find($id);
    }
    public function count(){}
    public function store($request){
        $validator = $this->validationProduct($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $product = new Product;
        $this->saveInformation($product, $request);
        $this->saveMainImage($product, $request);
        $this->saveSliderImage($product, $request);
        $product->status = Product::NO_STOCK;
        $product->created_by = Auth::user()->id;
        $product->save();
        Alert::success('Success', 'Successfully Created a new Product');
    }
    public function list($request){
        $products = $this->all();
        if ($request->post('brand')) {
            $products = Product::where('brand_id', $request->post('brand'))->get();
        }
        elseif ($request->post('product')) {
            $products = Product::where('product_id', $request->post('product'))->get();
        }
        elseif ($request->post('subproduct')) {
            $products = Product::where('sub_product_id', $request->post('subproduct'))->get();
        }
        elseif ($request->post('status')) {
            $products = Product::where('status', $request->post('status'))->get();
        }

        $totalData = $products->count();
        $totalFiltered = $totalData;
        $toReturn = array();

        foreach ($products as $product) {
            $show = route('customize.product.display', $product->id);
            $status_link = route('customize.product.status', $product->id);
            $localArray[0] = $product->id;
            $localArray[1] = $product->name;
            $localArray[2] = $product->brand->name;
            $localArray[3] = $product->category->name;
            $localArray[4] = $product->subCategory->name;
            $localArray[5] = $product->selling_price;
            $localArray[6] = Product::getStatus($product->status);
            $localArray[7] = $product->created_at->format('d.m.Y');
            $localArray[8] = "
                <div class='btn-group'>
                    <a href='{$show}' class='btn btn-sm btn-primary'>View</a>
                    <button type='button' class='btn btn-sm btn-primary dropdown-toggle dropdown-icon' data-toggle='dropdown'>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                    <div class='dropdown-menu' role='menu'>
                        <a class='dropdown-item' id='delete-product' data-product-id='{$product->id}'><i class='fas fa-trash-alt'></i> Delete</a>
                        <a class='dropdown-item' href='{$status_link}'>Status</a>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item' href='#'>Separated link</a>
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
    public function update($request, $id){}
    public function delete($request, $id){}
    private function validationProduct($request)
    {
        return  Validator::make($request->all(), [
            'product_name' => 'required',
            'product_brand'=> 'required',
            'product_product'=> 'required',
            'product_sub_product' => 'required',
            'product_color' => 'required|array',
            'product_feature' => 'required|array',
            'product_details' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'code' => 'required|unique:products',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'image_slider' => 'required',
        ]);
    }
    private function saveInformation($data, $request)
    {
        $data->brand_id = $request->post('product_brand');
        $data->product_id = $request->post('product_product');
        $data->sub_product_id = $request->post('product_sub_product');
        $data->name = $request->post('product_name');
        $data->code = $request->post('code');
        $data->details = $request->post('product_details');
        $data->buying_price = $request->post('buying_price');
        $data->selling_price = $request->post('selling_price');

        $colorArray = array();
        if($request->post('product_color')){
            foreach ($request->post('product_color') as $color) {
                $colorArray[] = $color;
            }
        }
        $color_string =  implode(",", $colorArray);
        $data->color_ids = $color_string;

        $featureArray = array();
        if ($request->post('product_feature')) {
            foreach ($request->post('product_feature') as $feature) {
                $featureArray[] = $feature;
            }
        }
        $feature_string =  implode(",", $featureArray);
        $data->feature_ids = $feature_string;
    }
    private function saveMainImage($data, $request){
        if ($request->file('product_image')) {
            $image = $request->file('product_image');
            $new_name = Auth::user()->id . '_p_' . date('mdy.His.i') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('product_image'), $new_name);
            $data->image = $new_name;
        }
    }
    private function saveSliderImage($data, $request){
        $imageNames = array();
        if ($request->file('image_slider')) {
            $count = 1;
            // dd($request->file('image_slider'));
            foreach ($request->file('image_slider') as $image) {
                $extension = $image[0]->getClientOriginalExtension();
                $name = Auth::user()->id . '_p_' . $count . '_' . $this->uniqueString() . ++$count . '.' . $extension;
                $image[0]->move(public_path('product_image'), $name);
                $imageNames[] = $name;
            }
        }
        $image_string =  implode(",", $imageNames);
        $data->image_slider = $image_string;
    }
    private function uniqueString()
    {
        $m = explode(' ', microtime());
        list($totalSeconds, $extraMilliseconds) = array($m[1], (int)round($m[0] * 1000, 3));
        $txID = date('YmdHis', $totalSeconds) . sprintf('%03d', $extraMilliseconds);
        $txID = substr($txID, 2, 15);
        return $txID;
    }
}