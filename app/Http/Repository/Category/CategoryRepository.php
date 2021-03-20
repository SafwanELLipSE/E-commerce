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
            $image = $category->image != null  ? asset('category_image/' . $category->image) : asset("/backend/dist/img/No image.png");
            $localArray[0] = $category->id;
            $localArray[1] = $category->name;
            $localArray[2] = "<img src='{$image}' alt='{$category->name}' class='img-centered img-thumbnail mx-auto d-block mt-2'>";
            $localArray[3] = category::getStatus($category->status);
            $localArray[4] = Auth::User($category->created_by)->name;
            $localArray[5] = $category->created_at->format('d.m.Y');
            $localArray[6] = "<a href='{$show}' class='btn btn-sm btn-info'><i class='fas fa-user-edit'></i></a>  <div class='btn btn-sm btn-danger' id='delete-category' data-category-id='{$category->id}'><i class='fas fa-trash-alt'></i></div>";
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