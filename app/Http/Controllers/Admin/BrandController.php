<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Repository\Brand\BrandInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    public function __construct(BrandInterface $brandRepository){
        $this->brandRepository = $brandRepository;
    }
    public function index(Request $request)
    {
        return view('backend.brands.brand_index');
    }
    
    // TODO: need to show error on the create tab panel.
    public function storeBrand(Request $request){
        $validator = Validator::make($request->all(),[
            'brand_name'         => 'required',
            'brand_image'         => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if ($validator->fails())
        {
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $this->brandRepository->store($request);
        Alert::success('Success', 'Successfully Created a new Brand');
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
          $validator = Validator::make($request->all(),[
            'brand_name'         => 'required',
            'brand_image'         => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if ($validator->fails())
        {
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $id = $request->post('brand_id');
        $this->brandRepository->update($request,$id);
        Alert::success('Success', 'Successfully Brand information has been updated.');
        return view('backend.brands.brand_edit',[
            'brand' => $this->brandRepository->get($id)
        ]);
    }
    public function destroyBrand(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:brands,id',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);

        $this->brandRepository->delete($request->post('id'));
        return response()->json("Succesfully, Brand has been deleted", 200);
    }
}
