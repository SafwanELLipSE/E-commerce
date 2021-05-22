<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Category\CategoryInterface;

class CategoryController extends Controller
{
    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index(Request $request)
    {
        return view('backend.category.category_index',[
            'count' => $this->categoryRepository->count()
        ]);
    }
    public function storeCategory(Request $request){
        $this->categoryRepository->store($request);
        return redirect()->back();
    }
    public function allCategoryList(Request $request){
        echo json_encode($this->categoryRepository->list($request));
    }
    public function editCategory(Request $request,$id){
        return view('backend.category.category_edit', [
            'category' => $this->categoryRepository->get($id)
        ]);
    }
    public function updateCategory(Request $request){
        $id = $request->post('category_id');
        $this->categoryRepository->update($request, $id);
        return redirect()->back();
    }
    public function destroyCategory(Request $request){
        $this->categoryRepository->delete($request,$request->post('id'));
        return response()->json("Successfully, Category has been deleted", 200);
    }
    public function changeStatus(Request $request,$id){
        $this->categoryRepository->status($request,$id); 
        return redirect()->back();
    }
    public function deleteSelectedCategory(Request $request)
    {
        $category_id_array = $request->input('id');
        $this->categoryRepository->selectedDelete($request, $category_id_array);
        return response()->json("Successfully, Categories has been deleted", 200);
    }
    public function deleteAllCategory(Request $request)
    {
        $this->categoryRepository->deleteAll($request);
        return response()->json("Successfully, All Categories has been deleted", 200);
    }
}
