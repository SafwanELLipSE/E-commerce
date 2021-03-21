<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Subcategory\SubcategoryInterface;
use App\Http\Repository\Category\CategoryInterface;

class SubCategoryController extends Controller
{
    public function __construct(SubcategoryInterface $subCategoryRepository, CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
    }
    public function index(Request $request)
    {
        return view('backend.subCategory.subCategory_index',[
            'categories' => $this->categoryRepository->all()
        ]);
    }
    public function storeSubcategory(Request $request){
        $this->subCategoryRepository->store($request);
        return redirect()->back();
    }
    public function allSubCategoryList(Request $request){
        echo json_encode($this->subCategoryRepository->list($request));
    }
    public function editSubcategory(Request $request, $id){
        return view('backend.subCategory.subCategory_edit', [
            'subCategory' => $this->subCategoryRepository->get($id)
        ]);
    }
    public function updateSubcategory(Request $request){
        $id = $request->post('subCategory_id');
        $this->subCategoryRepository->update($request, $id);
        return view('backend.subCategory.subCategory_edit', [
            'category' => $this->subCategoryRepository->get($id)
        ]);
    }
    public function destroySubcategory(Request $request){
        $this->subCategoryRepository->delete($request,$request->post('id'));
        return response()->json("Succesfully, Sub-category has been deleted", 200);
    }
    public function changeStatus(Request $request,$id){
        $this->subCategoryRepository->status($request,$id); 
        return redirect()->back();
    }
}
