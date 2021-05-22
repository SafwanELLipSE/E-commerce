<?php

namespace App\Http\Repository\Feature;
use App\Models\Feature;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class FeatureRepository implements FeatureInterface{
    public function all(){
        return Feature::all();
    }
    public function get($id){
        return Feature::find($id);
    }    
    public function count(){
        $totalFeature = $this->all()->count();
        return [
            'totalFeature' => $totalFeature
        ];
    }
    public function store($request){
        $validator = $this->validationFeature($request);
        if ($validator->fails())
        {
            alert()->warning('Error occured',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $feature = new Feature;
        $feature->name = $request->post('feature_name');
        $feature->save();
        Alert::success('Success', 'Successfully Created a new Feature');
    }
    public function list($request){
        $features = $this->all();
        $totalData = $features->count();
        $totalFiltered = $totalData;
        $toReturn = array();

        foreach ($features as $feature) {
            $show = route('customize.feature.edit', $feature->id);
            $localArray[0] = "<input type='checkbox' name='feature_checkbox[]' class='feature_checkbox mr-2' value='{$feature->id}'/>" . $feature->id;
            $localArray[1] = $feature->name;
            $localArray[2] = "<a href='{$show}' class='btn btn-sm btn-primary'><i class='fas fa-user-edit'></i></a> <a class='btn btn-sm btn-danger' id='delete-feature' data-feature-id='{$feature->id}'><i class='fas fa-trash-alt'></i></a>";
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
        $validator = $this->validationFeature($request);
        if ($validator->fails())
        {
            alert()->warning('Error occurred',$validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $feature = $this->get($id);
        $feature->name = $request->post('feature_name');
        $feature->save();
        Alert::success('Success', 'Successfully Feature information has been updated.');
    }
    public function delete($request, $id){
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:features,id',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);
        $feature = $this->get($id);
        $feature->delete();
    }
    public function selectedDelete($request, $id)
    {
        $feature = Feature::whereIn('id', $id)->delete();
    }
    public function deleteAll($request)
    {
        $feature = Feature::truncate();
    }
    private function validationFeature($request){
        return  Validator::make($request->all(),[
                    'feature_name'   => 'required',
                ]);
    }
}