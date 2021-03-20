<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Repository\Category\CategoryInterface;

class CategoryController extends Controller
{
    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index(Request $request)
    {
        return view('backend.category.category_index');
    }
    public function storeCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'category_name'         => 'required',
            'category_image'         => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error occured', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $this->categoryRepository->store($request);
        Alert::success('Success', 'Successfully Created a new Category');
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
        $validator = Validator::make($request->all(), [
            'category_name'         => 'required',
            'category_image'         => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error occured', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $id = $request->post('category_id');
        $this->categoryRepository->update($request, $id);
        Alert::success('Success', 'Successfully Category information has been updated.');
        return view('backend.category.category_edit', [
            'category' => $this->categoryRepository->get($id)
        ]);
    }
    public function destroyCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:categories,id',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);

        $this->categoryRepository->delete($request->post('id'));
        return response()->json("Succesfully, Category has been deleted", 200);
    }
}
