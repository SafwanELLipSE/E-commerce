<?php

namespace App\Http\Repository\Subcategory;

use App\Models\Sub_Category;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class SubcategoryRepository implements SubcategoryInterface
{
    public function all()
    {
        return Sub_Category::all();
    }
    public function get($id)
    {
        return Sub_Category::find($id);
    }
    public function count(){
        $totalsubCategory = $this->all()->count();
        $activesubCategory = Sub_Category::where('status',Sub_Category::ACTIVE)->count();
        $inactivesubCategory = Sub_Category::where('status',Sub_Category::INACTIVE)->count();
        $creatorsubCategory = Sub_Category::distinct('created_by')->count();

        return [
            'totalsubCategory' => $totalsubCategory,
            'activesubCategory' => $activesubCategory,
            'inactivesubCategory' => $inactivesubCategory,
            'creatorsubCategory' => $creatorsubCategory
        ];
    }
    public function store($request)
    {
        $validator = $this->validationSubcategory($request);
        if ($validator->fails())
        {
            alert()->warning('Error Occurred',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $subCategory = new Sub_Category;
        $this->saveInformation($subCategory, $request);
        $subCategory->status = Sub_Category::ACTIVE;
        $subCategory->created_by = Auth::user()->id;
        $subCategory->save();
        Alert::success('Success', 'Successfully Created a new Sub-Category');
    }
    public function list($request)
    {
        $subCategories = $this->all();
        if ($request->post('status')) {
            $subCategories = Sub_Category::where('status', $request->post('status'))->get();
        }
        if ($request->post('category')) {
            $subCategories = Sub_Category::where('category_id', $request->post('category'))->get();
        }

        $totalData = $subCategories->count();
        $totalFiltered = $totalData;
        $toReturn = array();

        foreach ($subCategories as $subCategory) {
            $show = route('customize.subCategory.edit', $subCategory->id);
            $status_link = route('customize.subCategory.status', $subCategory->id);
            $image = $subCategory->image != null  ? asset('subCategory_image/' . $subCategory->image) : asset("assets/backend/dist/img/No image.png");
            $status_icon = $subCategory->status != 1 ? "fa-check" : "fa-times";
            $status_color = $subCategory->status != 1 ? "btn-success" : "btn-danger";
            $localArray[0] = $subCategory->id;
            $localArray[1] = $subCategory->name;
            $localArray[2] = isset($subCategory->category->name) ? $subCategory->category->name : 'No Longer Available';
            $localArray[3] = "<img src='{$image}' alt='{$subCategory->name}' class='img-centered img-thumbnail mx-auto d-block mt-2'>";
            $localArray[4] = Sub_Category::getStatus($subCategory->status);
            $localArray[5] = Auth::User($subCategory->created_by)->name;
            $localArray[6] = $subCategory->created_at->format('d.m.Y');
            $localArray[7] = "<a href='{$show}' class='btn btn-sm btn-info'><i class='fas fa-user-edit'></i></a> <a href='{$status_link}' class='btn btn-sm {$status_color}'><i class='fas {$status_icon}'></i></a> <div class='btn btn-sm btn-warning' id='delete-subCategory' data-subCategory-id='{$subCategory->id}'><i class='fas fa-trash-alt text-light'></i></div>";
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
    public function update($request, $id)
    {
        $validator = $this->validationSubcategory($request);
        if ($validator->fails())
        {
            alert()->warning('Error Occurred',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $subCategory = $this->get($id);
        if($request->file('subCategory_image'))
        {
            if($subCategory->image != null)
            {
                $path_image = public_path().'/subCategory_image/'. $subCategory->image;
                if(file_exists($path_image) == true)
                {
                    unlink($path_image);
                }
            }
        }
        $this->saveInformation($subCategory, $request);
        $subCategory->save();
        Alert::success('Success', 'Successfully Sub-category information has been updated.');
    }
    public function delete($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:sub_categories,id',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);

        $subCategory = $this->get($id);
        if($subCategory->image != null)
        {
            $path_image = public_path().'/subCategory_image/'. $subCategory->image;
            if(file_exists($path_image) == true)
            {
                unlink($path_image);
            }
        }
        $subCategory->delete();
    }
    public function status($request,$id){
        $subCategory = $this->get($id);
        if($subCategory->status == Sub_Category::ACTIVE){
            $subCategory->status = Sub_Category::INACTIVE;
        }elseif($subCategory->status == Sub_Category::INACTIVE){
            $subCategory->status = Sub_Category::ACTIVE;
        }
        $subCategory->save();
        Alert::success('Success', 'Successfully Status of Sub-category has been changed.');
    }
    private function validationSubcategory($request){
        return Validator::make($request->all(),[
                    'subCategory_name'   => 'required',
                    'category'           => 'required',
                    'subCategory_image'  => 'image|mimes:jpeg,png,jpg,svg|max:2048',
                ]);
    }
    private function saveInformation($data, $request){
        $data->name = $request->post('subCategory_name');
        $data->category_id = $request->post('category');
        if($request->file('subCategory_image')){
            $image = $request->file('subCategory_image');
            $new_name = Auth::user()->id . '_b_' . date('mdy.His.i') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('subCategory_image'), $new_name);
            $data->image = $new_name;
        }
    }
}
