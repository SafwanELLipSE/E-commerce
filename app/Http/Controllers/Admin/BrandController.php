<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Repository\Brand\BrandInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(BrandInterface $brandRepository){
        $this->brandRepository = $brandRepository;
    }
    public function index(Request $request)
    {
        return view('backend.brands.brand_index',[
            'count' => $this->brandRepository->count()
        ]);
    }
    public function storeBrand(Request $request){
        $this->brandRepository->store($request);
        return redirect()->back();
    }
    public function allBrandList(Request $request){
        echo json_encode($this->brandRepository->list($request));
    }
    public function editBrand(Request $request,$id){
        return view('backend.brands.brand_edit',[
            'brand' => $this->brandRepository->get($id)
        ]);
    }
    public function updateBrand(Request $request){
        $id = $request->post('brand_id');
        $this->brandRepository->update($request,$id);
        return view('backend.brands.brand_edit',[
            'brand' => $this->brandRepository->get($id)
        ]);
    }
    public function destroyBrand(Request $request){
        $this->brandRepository->delete($request,$request->post('id'));
        return response()->json("Successfully, Brand has been deleted", 200);
    }
    public function changeStatus(Request $request, $id){
        $this->brandRepository->status($request,$id); 
        return redirect()->back();
    }
    public function deleteSelectedBrand(Request $request)
    {
        $brand_id_array = $request->input('id');
        $this->brandRepository->selectedDelete($request, $brand_id_array);
        return response()->json("Successfully, Brands has been deleted", 200);
    }
    public function deleteAllBrand(Request $request)
    {
        $this->brandRepository->deleteAll($request);
        return response()->json("Successfully, All Brands has been deleted", 200);
    }
}
