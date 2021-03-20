<?php

namespace App\Http\Repository\Brand;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class BrandRepository implements BrandInterface{
    public function all(){
        return Brand::all();
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
            $image = $brand->image != null  ? asset('brand_image/' . $brand->image) : asset("/backend/dist/img/No image.png");
            $localArray[0] = $brand->id;
            $localArray[1] = $brand->name;
            $localArray[2] = "<img src='{$image}' alt='$brand->name' class='img-centered img-thumbnail mx-auto d-block mt-2'>";
            $localArray[3] = Brand::getStatus($brand->status);
            $localArray[4] = Auth::User($brand->created_by)->name;
            $localArray[5] = $brand->created_at->format('d.m.Y');
            $localArray[6] = "<a href='{$show}' class='btn btn-sm btn-info'><i class='fas fa-user-edit'></i></a>  <div class='btn btn-sm btn-danger' id='delete-brand' data-brand-id='{$brand->id}'><i class='fas fa-trash-alt'></i></div>";
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
        $this->saveData($brand, $request);
        $brand->save();
    }
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