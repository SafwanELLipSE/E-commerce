<?php

namespace App\Http\Repository\Brand;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BrandRepository implements BrandInterface{
    public function all(){
        return Brand::all();
    }
    public function get($id){
        return Brand::find($id);
    }
    public function store($request){
        $validator = $this->validationBrand($request);
        if ($validator->fails())
        {
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $brand = new Brand;
        $this->saveInformation($brand, $request);
        $brand->status = Brand::ACTIVE;
        $brand->created_by = Auth::user()->id;
        $brand->save();
        Alert::success('Success', 'Successfully Created a new Brand');
    }
    public function list($request)
    {
        $brands = $this->all();
        if ($request->post('status')) {
            $brands = Brand::where('status', $request->post('status'))->get();
        }

        $totalData = $brands->count();
        $totalFiltered = $totalData;
        $toReturn = array();

        foreach ($brands as $brand) {
            $show = route('customize.brand.edit', $brand->id);
            $status_link = route('customize.brand.status', $brand->id);
            $image = $brand->image != null  ? asset('brand_image/' . $brand->image) : asset("/backend/dist/img/No image.png");
            $status_icon = $brand->status != 1 ? "fa-check" : "fa-times";
            $status_color = $brand->status != 1 ? "btn-success" : "btn-danger";
            $localArray[0] = $brand->id;
            $localArray[1] = $brand->name;
            $localArray[2] = "<img src='{$image}' alt='$brand->name' class='img-centered img-thumbnail mx-auto d-block mt-2'>";
            $localArray[3] = Brand::getStatus($brand->status);
            $localArray[4] = Auth::User($brand->created_by)->name;
            $localArray[5] = $brand->created_at->format('d.m.Y');
            $localArray[6] = "<a href='{$show}' class='btn btn-sm btn-primary'><i class='fas fa-user-edit'></i></a> <a href='{$status_link}' class='btn btn-sm {$status_color}'><i class='fas {$status_icon}'></i></a> <a class='btn btn-sm btn-danger' id='delete-brand' data-brand-id='{$brand->id}'><i class='fas fa-trash-alt'></i></a>";
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
    public function update($request,$id){
        $validator = $this->validationBrand($request);
        if ($validator->fails())
        {
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $brand = $this->get($id);
        if($request->file('brand_image'))
        {
            if($brand->image != null)
            {
                $path_image = public_path().'/brand_image/'. $brand->image;
                if(file_exists($path_image) == true)
                {
                    unlink($path_image);
                }
            }
        }
        $this->saveInformation($brand, $request);
        $brand->save();
        Alert::success('Success', 'Successfully Brand information has been updated.');
    }
    public function delete($request,$id){
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:brands,id',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);

        $brand = $this->get($id);
        if($brand->image != null)
        {
            $path_image = public_path().'/brand_image/'. $brand->image;
            if(file_exists($path_image) == true)
            {
                unlink($path_image);
            }
        }
        $brand->delete();
    }
    public function status($request,$id){
        $brand = $this->get($id);
        if($brand->status == Brand::ACTIVE){
            $brand->status = Brand::INACTIVE;
        }elseif($brand->status == Brand::INACTIVE){
            $brand->status = Brand::ACTIVE;
        }
        $brand->save();
        Alert::success('Success', 'Successfully Status of Brand has been changed.');
    }
    private function validationBrand($request){
        return  Validator::make($request->all(),[
                    'brand_name'   => 'required',
                    'brand_image'  => 'image|mimes:jpeg,png,jpg,svg|max:2048',
                ]);
    }
    private function saveInformation($data, $request){
        $data->name = $request->post('brand_name');
        if($request->file('brand_image')){
            $image = $request->file('brand_image');
            $new_name = Auth::user()->id . '_b_' . date('mdy.His.i') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('brand_image'), $new_name);
            $data->image = $new_name;
        }
    }
}