<?php

namespace App\Http\Repository\Category;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryRepository implements CategoryInterface{
    public function all(){
        return Category::paginate(25);
    }
    public function get($id){
        return Category::find($id);
    }
    public function store($request){
        $category = new Category;
        $this->saveData($category, $request);
        $category->status = Category::ACTIVE;
        $category->created_by = Auth::user()->id;
        $category->save();
    }
    public function update($request, $id){
        $category = $this->get($id);
        if ($request->file('category_image')) {
            if ($category->image != null) {
                $path_image = public_path() . '/category_image/' . $category->image;
                if (file_exists($path_image) == true) {
                    unlink($path_image);
                }
            }
        }
        $this->saveData($category, $request);
        $category->save();
    }
    public function delete($id){
        $category = $this->get($id);
        if ($category->image != null) {
            $path_image = public_path() . '/category_image/' . $category->image;
            if (file_exists($path_image) == true) {
                unlink($path_image);
            }
        }
        $category->delete();
    }
    private function saveData($data, $request)
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