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
        $brand = new Brand;
        $this->saveData($brand, $request);
        $brand->status = Brand::ACTIVE;
        $brand->created_by = Auth::user()->id;
        $brand->save();
        Alert::success('Success', 'Successfully Created a new Brand');
    }
    public function update($request,$id){
        $brand = Brand::find($id);
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
        $this->saveData($brand, $request);
        $brand->save();
        Alert::success('Success', 'Successfully Brand information has been updated.');
    }
    // TODO: need to use ajax delete for easlier and btr solution.
    public function delete($id){
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
        Alert::success('Success', 'Successfully Brand information has been deleted.');
    }

    private function saveData($data, $request){
        $data->name = $request->post('brand_name');
        if($request->file('brand_image')){
            $image = $request->file('brand_image');
            $new_name = Auth::user()->id . '_b_' . date('mdy.His.i') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('brand_image'), $new_name);
            $data->image = $new_name;
        }
    }
}