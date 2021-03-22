<?php

namespace App\Http\Repository\Slider;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SliderRepository implements SliderInterface{
    public function all(){
        return Slider::all();
    }
    public function get($id){
        return Slider::find($id);
    }
    public function count(){
        $totalSlider = $this->all()->count();
        $activeSlider = Slider::where('status',Slider::ACTIVE)->count();
        $inactiveSlider = Slider::where('status',Slider::INACTIVE)->count();
        $creatorSlider = Slider::distinct('created_by')->count();

        return [
            'totalSlider' => $totalSlider,
            'activeSlider' => $activeSlider,
            'inactiveSlider' => $inactiveSlider,
            'creatorSlider' => $creatorSlider
        ];
    }
    public function store($request){
        $validator = $this->validationSlider($request);
        if ($validator->fails())
        {
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $slider = new Slider;
        $this->saveInformation($slider, $request);
        $slider->status = Slider::ACTIVE;
        $slider->created_by = Auth::user()->id;
        $slider->save();
        Alert::success('Success', 'Successfully Created a new Slider');
    }
    public function list($request){
        $sliders = $this->all();
        if ($request->post('status')) {
            $sliders = Slider::where('status', $request->post('status'))->get();
        }

        $totalData = $sliders->count();
        $totalFiltered = $totalData;
        $toReturn = array();

        foreach ($sliders as $slider) {
            $show = route('customize.slider.edit', $slider->id);
            $status_link = route('customize.slider.status', $slider->id);
            $image = $slider->image != null  ? asset('slider_image/' . $slider->image) : asset("/backend/dist/img/No image.png");
            $status_icon = $slider->status != 1 ? "fa-check" : "fa-times";
            $status_color = $slider->status != 1 ? "btn-success" : "btn-danger";
            $localArray[0] = $slider->id;
            $localArray[1] = $slider->title;
            $localArray[2] = $slider->sub_title;
            $localArray[3] = "<img src='{$image}' alt='$slider->name' class='img-centered img-thumbnail mx-auto d-block mt-2'>";
            $localArray[4] = Slider::getStatus($slider->status);
            $localArray[5] = Auth::User($slider->created_by)->name;
            $localArray[6] = $slider->created_at->format('d.m.Y');
            $localArray[7] = "<a href='{$show}' class='btn btn-sm btn-primary'><i class='fas fa-user-edit'></i></a> <a href='{$status_link}' class='btn btn-sm {$status_color}'><i class='fas {$status_icon}'></i></a> <a class='btn btn-sm btn-danger' id='delete-slider' data-slider-id='{$slider->id}'><i class='fas fa-trash-alt'></i></a>";
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
        $validator = $this->validationSlider($request);
        if ($validator->fails())
        {
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $slider = $this->get($id);
        if($request->file('slider_image'))
        {
            if($slider->image != null)
            {
                $path_image = public_path().'/slider_image/'. $slider->image;
                if(file_exists($path_image) == true)
                {
                    unlink($path_image);
                }
            }
        }
        $this->saveInformation($slider, $request);
        $slider->save();
        Alert::success('Success', 'Successfully Slider information has been updated.');
    }
    public function delete($request, $id){
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:slider,id',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);

        $slider = $this->get($id);
        if($slider->image != null)
        {
            $path_image = public_path().'/slider_image/'. $slider->image;
            if(file_exists($path_image) == true)
            {
                unlink($path_image);
            }
        }
        $slider->delete();
    }
    public function status($request,$id){
        $slider = $this->get($id);
        if($slider->status == Slider::ACTIVE){
            $slider->status = Slider::INACTIVE;
        }elseif($slider->status == Slider::INACTIVE){
            $slider->status = Slider::ACTIVE;
        }
        $slider->save();
        Alert::success('Success', 'Successfully Status of Slider has been changed.');
    }
    private function validationSlider($request){
        return  Validator::make($request->all(),[
                    'slider_title'   => 'required',
                    'slider_subTitle'   => 'required',
                    'slider_image'  => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                ]);
    }
    private function saveInformation($data, $request){
        $data->title = $request->post('slider_title');
        $data->sub_title = $request->post('slider_subTitle');
        if($request->file('slider_image')){
            $image = $request->file('slider_image');
            $new_name = Auth::user()->id . '_s_' . date('mdy.His.i') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('slider_image'), $new_name);
            $data->image = $new_name;
        }
    }
}