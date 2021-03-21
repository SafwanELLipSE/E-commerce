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
    public function store($request)
    {
        $validator = $this->validationSubcatgory($request);
        if ($validator->fails())
        {
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $subCatgory = new Sub_Category;
        $this->saveInformation($subCatgory, $request);
        $subCatgory->status = Sub_Category::ACTIVE;
        $subCatgory->created_by = Auth::user()->id;
        $subCatgory->save();
        Alert::success('Success', 'Successfully Created a new Sub-Catgory');
    }
    public function list($request)
    {
        $subCatgories = $this->all();
        if ($request->post('status')) {
            $subCatgories = Sub_Category::where('status', $request->post('status'))->get();
        }

        $totalData = $subCatgories->count();
        $totalFiltered = $totalData;
        $toReturn = array();

        foreach ($subCatgories as $subCatgory) {
            $show = route('customize.subCategory.edit', $subCatgory->id);
            $status_link = route('customize.subCategory.status', $subCatgory->id);
            $image = $subCatgory->image != null  ? asset('subCategory_image/' . $subCatgory->image) : asset("/backend/dist/img/No image.png");
            $status_icon = $subCatgory->status != 1 ? "fa-check" : "fa-times";
            $status_color = $subCatgory->status != 1 ? "btn-success" : "btn-danger";
            $localArray[0] = $subCatgory->id;
            $localArray[1] = $subCatgory->name;
            $localArray[2] = $subCatgory->category->name;
            $localArray[3] = "<img src='{$image}' alt='{$subCatgory->name}' class='img-centered img-thumbnail mx-auto d-block mt-2'>";
            $localArray[4] = Sub_Category::getStatus($subCatgory->status);
            $localArray[5] = Auth::User($subCatgory->created_by)->name;
            $localArray[6] = $subCatgory->created_at->format('d.m.Y');
            $localArray[7] = "<a href='{$show}' class='btn btn-sm btn-info'><i class='fas fa-user-edit'></i></a> <a href='{$status_link}' class='btn btn-sm {$status_color}'><i class='fas {$status_icon}'></i></a> <div class='btn btn-sm btn-warning' id='delete-subCatgory' data-subCatgories-id='{$subCatgory->id}'><i class='fas fa-trash-alt text-light'></i></div>";
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
        $validator = $this->validationSubcatgory($request);
        if ($validator->fails())
        {
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $subCatgory = $this->get($id);
        if($request->file('subCatgory_image'))
        {
            if($subCatgory->image != null)
            {
                $path_image = public_path().'/subCatgory_image/'. $subCatgory->image;
                if(file_exists($path_image) == true)
                {
                    unlink($path_image);
                }
            }
        }
        $this->saveInformation($subCatgory, $request);
        $subCatgory->save();
        Alert::success('Success', 'Successfully Sub-catgory information has been updated.');
    }
    public function delete($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:sub_categories,id',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);

        $subCatgory = $this->get($id);
        if($subCatgory->image != null)
        {
            $path_image = public_path().'/subCatgory_image/'. $subCatgory->image;
            if(file_exists($path_image) == true)
            {
                unlink($path_image);
            }
        }
        $subCatgory->delete();
    }
    public function status($request,$id){
        $subCatgory = $this->get($id);
        if($subCatgory->status == Sub_Category::ACTIVE){
            $subCatgory->status = Sub_Category::INACTIVE;
        }elseif($subCatgory->status == Sub_Category::INACTIVE){
            $subCatgory->status = Sub_Category::ACTIVE;
        }
        $subCatgory->save();
        Alert::success('Success', 'Successfully Status of Sub-category has been changed.');
    }
    private function validationSubcatgory($request){
        return  Validator::make($request->all(),[
                    'subCatgory_name'   => 'required',
                    'subCatgories'          => 'required',
                    'subCatgory_image'  => 'image|mimes:jpeg,png,jpg,svg|max:2048',
                ]);
    }
    private function saveInformation($data, $request){
        $data->name = $request->post('subCatgory_name');
        $data->subCatgories_id = $request->post('subCatgories');
        if($request->file('subCatgory_image')){
            $image = $request->file('subCatgory_image');
            $new_name = Auth::user()->id . '_b_' . date('mdy.His.i') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('subCatgory_image'), $new_name);
            $data->image = $new_name;
        }
    }
}
