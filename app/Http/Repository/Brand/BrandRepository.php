<?php

namespace App\Http\Repository\Brand;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
class BrandRepository implements BrandInterface{
    public function all(){
        return Brand::paginate(25);
    }
    public function get($id){
        return Brand::find($id);
    }
    public function store($request){
        $validator = Validator::make($request->all(),[
            'brand_name'         => 'required',
            'brand_image'         => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if ($validator->fails())
        {
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $brand = new Brand;
        $this->saveData($brand, $request);
        $brand->save();
    }
    public function update($request,$id){
        $validator = Validator::make($request->all(),[
            'brand_name'         => 'required',
            'brand_image'         => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if ($validator->fails())
        {
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $brand = Brand::find($id);
        if($request->image)
        {
            if($image_link != null)
            {
                $path_image = public_path().'/brand_image/'. $brand->image;
                if(file_exists($path_image) == true)
                {
                    unlink($path_image);
                }
            }
        }
        $this->saveData($brand, $request);
        $brand->save();
    }
    public function delete($id){
        $brand = Brand::destory($id);
    }

    private function saveData($data, $request){
        $data->name = $request->post('brand_name');
        if($request->file('brand_image')){
            $image = $request->file('brand_image');
            $new_name = Auth::user()->id . '_b_' . date('mdy.His.i') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('brand_image'), $new_name);
            $data->image = $new_name;
        }
        $data->status = Brand::ACTIVE;
    }
}