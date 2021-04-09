<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Feature\FeatureInterface;
use App\Http\Repository\Color\ColorInterface;

class FeatureController extends Controller
{
    public function __construct(FeatureInterface $featureRepository, ColorInterface $colorRepository)
    {
        $this->featureRepository = $featureRepository;
        $this->colorRepository = $colorRepository;
    }
    public function index(){
        return view('backend.features.feature_index',[
            'count' => $this->featureRepository->count(),
            'countColor' => $this->colorRepository->count()
        ]);
    }
    public function storeFeature(Request $request){
        $this->featureRepository->store($request);
        return redirect()->back();
    }
    public function allFeatureList(Request $request){
        echo json_encode($this->featureRepository->list($request));
    }
    public function editFeature(Request $request,$id){
        return view('backend.features.feature_edit',[
            'feature' => $this->featureRepository->get($id)
        ]);
    }
    public function updateFeature(Request $request){
        $id = $request->post('feature_id');
        $this->featureRepository->update($request,$id);
        return view('backend.features.feature_edit',[
            'feature' => $this->featureRepository->get($id)
        ]);
    }
    public function destroyFeature(Request $request){
        $this->featureRepository->delete($request,$request->post('id'));
        return response()->json("Successfully, Feature has been deleted", 200);
    }
}
