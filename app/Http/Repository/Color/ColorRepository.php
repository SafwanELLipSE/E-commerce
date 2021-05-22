<?php

namespace App\Http\Repository\Color;

use App\Models\Color;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class ColorRepository implements ColorInterface
{
    public function all(){
        return Color::all();
    }
    public function get($id){
        return Color::find($id);
    }
    public function count(){
        $totalColor = Color::distinct('name')->count();
        $totalColorCode = Color::distinct('code')->count();
        $creatorColor = Color::distinct('created_by')->count();
        return [
            'totalColor' => $totalColor,
            'totalColorCode' => $totalColorCode,
            'creatorColor' => $creatorColor
        ];
    }
    public function store($request)
    {
        $validator = $this->validationColor($request);
        if ($validator->fails()) {
            alert()->warning('Error occured', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $color = new Color;
        $this->saveInformation($color, $request);
        $color->created_by = Auth::user()->id;
        $color->save();
        Alert::success('Success', 'Successfully, We have Created a new Color');
    }
    public function list($request){
        $colors = $this->all();

        $totalData = $colors->count();
        $totalFiltered = $totalData;
        $toReturn = array();

        foreach ($colors as $color) {
            $show = route('customize.color.edit', $color->id);
            $localArray[0] = "<input type='checkbox' name='color_checkbox[]' class='color_checkbox mr-2' value='{$color->id}'/>" . $color->id;
            $localArray[1] = $color->name;
            $localArray[2] = $color->code;
            $localArray[3] = "<button style='background-color:{$color->code} !important; border-color: white !important; width:70px; height:20px;' class='btn text-center'></button>";
            $localArray[4] = Auth::User($color->created_by)->name;
            $localArray[5] = $color->created_at->format('d.m.Y');
            $localArray[6] = "<a href='{$show}' class='btn btn-sm btn-info'><i class='fas fa-user-edit'></i></a> 
                            <a class='btn btn-sm btn-danger' id='delete-color' data-color-id='{$color->id}'><i class='fas fa-trash-alt'></i></a>";
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
        $validator = $this->validationColor($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $color = $this->get($id);
        $this->saveInformation($color, $request);
        $color->save();
        Alert::success('Success', 'Successfully Color information has been updated.');
    }
    public function delete($request, $id){
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:colors,id',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);
        $color = $this->get($id);
        $color->delete();
    }
    public function selectedDelete($request, $id)
    {
        $color = Color::whereIn('id', $id)->delete();
    }
    public function deleteAll($request)
    {
        $color = Color::truncate();
    }
    private function validationColor($request)
    {
        return  Validator::make($request->all(), [
            'color_name'   => 'required',
            'color_code'  => 'required',
        ]);
    }
    private function saveInformation($data, $request)
    {
        $data->name = $request->post('color_name');
        $data->code = $request->post('color_code');
    }
}
