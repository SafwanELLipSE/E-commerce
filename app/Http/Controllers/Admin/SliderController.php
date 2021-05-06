<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Slider\SliderInterface;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function __construct(SliderInterface $sliderRepository){
        $this->sliderRepository = $sliderRepository;
    }
    public function index(){
        return view('backend.slider.slider_index');
    }
    public function storeSlider(Request $request){
        $this->sliderRepository->store($request);
        return redirect()->back();
    }
    public function allSliderList(Request $request){
        echo json_encode($this->sliderRepository->list($request));
    }
    public function editSlider(Request $request,$id){
        return view('backend.slider.slider_edit',[
            'slider' => $this->sliderRepository->get($id)
        ]);
    }
    public function updateSlider(Request $request){
        $id = $request->post('slider_id');
        $this->sliderRepository->update($request,$id);
        return view('backend.slider.slider_edit',[
            'brand' => $this->sliderRepository->get($id)
        ]);
    }
    public function destroySlider(Request $request){
        $this->sliderRepository->delete($request,$request->post('id'));
        return response()->json("Successfully, Slider has been deleted", 200);
    }
    public function changeStatus(Request $request,$id){
        $this->sliderRepository->status($request,$id); 
        return redirect()->back();
    }
}
