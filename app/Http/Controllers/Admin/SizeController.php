<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Size\SizeInterface;
use App\Http\Repository\Subcategory\SubcategoryInterface;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function __construct(SizeInterface $sizeRepository, SubcategoryInterface $subCategoryRepository)
    {
        $this->sizeRepository = $sizeRepository;
        $this->subCategoryRepository = $subCategoryRepository;
    }
    public function index(Request $request)
    {
        return view('backend.subCategory.size_model', [
            'subCategories' => $this->subCategoryRepository->all(),
        ]);
    }
    public function storeSize(Request $request)
    {
        $this->sizeRepository->store($request);
        return redirect()->back();
    }
    public function allSizeList(Request $request)
    {
        echo json_encode($this->sizeRepository->list($request));
    }
    public function editSize(Request $request, $id)
    {
        return view('backend.subCategory.size_edit', [
            'size' => $this->sizeRepository->get($id),
            'subCategories' => $this->subCategoryRepository->all()
        ]);
    }
    public function updateSize(Request $request)
    {
        $id = $request->post('size_id');
        $this->sizeRepository->update($request, $id);
        return view('backend.subCategory.size_edit', [
            'size' => $this->sizeRepository->get($id)
        ]);
    }
    public function destroySize(Request $request)
    {
        $this->sizeRepository->delete($request, $request->post('id'));
        return response()->json("Successfully, Size has been deleted", 200);
    }
    public function changeStatus(Request $request, $id)
    {
        $this->sizeRepository->status($request, $id);
        return redirect()->back();
    }
}
