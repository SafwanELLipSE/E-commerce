<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Subcategory\SubcategoryInterface;
use App\Http\Repository\Category\CategoryInterface;
use App\Http\Repository\Size\SizeInterface;
class SubCategoryController extends Controller
{
    public function __construct(SubcategoryInterface $subCategoryRepository, CategoryInterface $categoryRepository, SizeInterface  $sizeRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->sizeRepository = $sizeRepository;
    }
    public function index(Request $request)
    {
        return view('backend.subCategory.subCategory_index',[
            'categories' => $this->categoryRepository->all(),
            'subCategories' => $this->subCategoryRepository->all(),
            'count' => $this->subCategoryRepository->count(),
            'countSize' => $this->sizeRepository->count()
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
            'subCategory' => $this->subCategoryRepository->get($id),
            'categories' => $this->categoryRepository->all()
        ]);
    }
    public function updateSubcategory(Request $request){
        $id = $request->post('subCategory_id');
        $this->subCategoryRepository->update($request, $id);
        return redirect()->back();
    }
    public function destroySubcategory(Request $request){
        $this->subCategoryRepository->delete($request,$request->post('id'));
        return response()->json("Successfully, Sub-category has been deleted", 200);
    }
    public function changeStatus(Request $request,$id){
        $this->subCategoryRepository->status($request,$id); 
        return redirect()->back();
    }
}
