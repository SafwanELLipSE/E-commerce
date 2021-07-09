<?php

namespace App\Http\Repository\Category;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class CategoryRepository implements CategoryInterface{
    public function all(){
        return Category::all();
    }
    public function get($id){
        return Category::find($id);
    }
    public function count(){
        $totalCategory = $this->all()->count();
        $activeCategory = Category::where('status',Category::ACTIVE)->count();
        $inactiveCategory = Category::where('status',Category::INACTIVE)->count();
        $creatorCategory = Category::distinct('created_by')->count();

        return [
            'totalCategory' => $totalCategory,
            'activeCategory' => $activeCategory,
            'inactiveCategory' => $inactiveCategory,
            'creatorCategory' => $creatorCategory
        ];
    }
    public function store($request){
        $validator = $this->validationCategory($request);
        if ($validator->fails()) {
            alert()->warning('Error occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $category = new Category;
        $this->saveInformation($category, $request);
        $category->status = Category::ACTIVE;
        $category->created_by = Auth::user()->id;
        $category->save();
        Alert::success('Success', 'Successfully Created a new Category');
    }
    public function list($request)
    {
        $categories = $this->all();
        if ($request->post('status')) {
            $categories = Category::where('status', $request->post('status'))->get();
        }

        $totalData = $categories->count();
        $totalFiltered = $totalData;
        $toReturn = array();

        foreach ($categories as $category) {
            $show = route('customize.category.edit', $category->id);
            $status_link = route('customize.category.status', $category->id);
            $image = $category->image != null ? asset('category_image/' . $category->image) : asset("/backend/dist/img/No image.png");
            $status_icon = $category->status != 1 ? "fa-check" : "fa-times";
            $status_color = $category->status != 1 ? "btn-success" : "btn-danger";
            $localArray[0] = "<input type='checkbox' name='category_checkbox[]' class='category_checkbox mr-2' value='{$category->id}'/>" . $category->id;
            $localArray[1] = $category->name;
            $localArray[2] = "<img src='{$image}' alt='{$category->name}' class='img-centered img-thumbnail mx-auto d-block mt-2'>";
            $localArray[3] = category::getStatus($category->status);
            $localArray[4] = Auth::User($category->created_by)->name;
            $localArray[5] = $category->created_at->format('d.m.Y');
            $localArray[6] = "<a href='{$show}' class='btn btn-sm btn-info'><i class='fas fa-user-edit'></i></a> 
                            <a href='{$status_link}' class='btn btn-sm {$status_color}'><i class='fas {$status_icon}'></i></a> 
                            <a class='btn btn-sm btn-danger' id='delete-category' data-category-id='{$category->id}'><i class='fas fa-trash-alt'></i></a>";
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
        $validator = $this->validationCategory($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $category = $this->get($id);
        if ($request->file('category_image')) {
            if ($category->image != null) {
                $path_image = public_path() . '/category_image/' . $category->image;
                if (file_exists($path_image) == true) {
                    unlink($path_image);
                }
            }
        }
        $this->saveInformation($category, $request);
        $category->save();
        Alert::success('Success', 'Successfully Category information has been updated.');
    }
    public function delete($request,$id){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);

        $category = $this->get($id);
        if ($category->image != null) {
            $path_image = public_path() . '/category_image/' . $category->image;
            if (file_exists($path_image) == true) {
                unlink($path_image);
            }
        }
        $category->delete();
    }
    public function status($request,$id){
        $category = $this->get($id);
        if($category->status == Category::ACTIVE){
            $category->status = Category::INACTIVE;
        }elseif($category->status == Category::INACTIVE){
            $category->status = Category::ACTIVE;
        }
        $category->save();
        Alert::success('Success', 'Successfully Status of Category has been changed.');
    }
    public function selectedDelete($request, $id)
    {
        $categoryImage = Category::whereIn('id', $id)->pluck('image');
        if (count($categoryImage) != 0) {
            foreach ($categoryImage as $image) {
                $path_image = public_path() . '/category_image/' . $image;
                if (file_exists($path_image) == true) {
                    unlink($path_image);
                }
            }
        }
        $category = Category::whereIn('id', $id)->delete();
    }
    public function deleteAll($request)
    {
        $allCategoryImages = Category::pluck('image');
        if (count($allCategoryImages) != 0) {
            foreach ($allCategoryImages as $image) {
                $path_image = public_path() . '/category_image/' . $image;
                if (file_exists($path_image) == true) {
                    unlink($path_image);
                }
            }
        }
        $category = Category::truncate();
    }
    private function validationCategory($request){
        return  Validator::make($request->all(),[
            'category_name'   => 'required',
            'category_image'  => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
    }
    private function saveInformation($data, $request)
    {
        $data->name = $request->post('category_name');
        if ($request->file('category_image')) {
            $image = $request->file('category_image');
            $new_name = Auth::user()->id . '_c_' . date('mdy.His.i') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('category_image'), $new_name);
            $data->image = $new_name;
        }
    }
}