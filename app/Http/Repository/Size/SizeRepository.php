<?php

namespace App\Http\Repository\Size;

use App\Models\Size;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class SizeRepository implements SizeInterface
{
    public function all()
    {
        return Size::all();
    }
    public function get($id)
    {
        return Size::find($id);
    }
    public function count()
    {
        $totalSize = $this->all()->count();
        $activeSize = Size::where('status', Size::ACTIVE)->count();
        $inactiveSize = Size::where('status', Size::INACTIVE)->count();
        $creatorSize = Size::distinct('created_by')->count();

        return [
            'totalSize' => $totalSize,
            'activeSize' => $activeSize,
            'inactiveSize' => $inactiveSize,
            'creatorSize' => $creatorSize
        ];
    }
    public function list($request)
    {
    }
    public function store($request)
    {
        $validator = $this->validationSize($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $size = new Size;
        $this->saveInformation($size, $request);
        $size->status = Size::ACTIVE;
        $size->created_by = Auth::user()->id;
        $size->save();
        Alert::success('Success', 'Successfully Created a new Size');
    }
    public function update($request, $id)
    {
        $validator = $this->validationSize($request);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $size = $this->get($id);
        $this->saveInformation($size, $request);
        $size->save();
        Alert::success('Success', 'Successfully Size information has been updated.');
    }
    public function delete($request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:sizes,id',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors()->all()[0], 422);

        $size = $this->get($id);
        $size->delete();
    }
    public function status($request, $id)
    {
        
    }
    private function validationSize($request)
    {
        return Validator::make($request->all(), [
            'size_name'   => 'required',
            'subCategory' => 'required',
        ]);
    }
    private function saveInformation($data, $request)
    {
        $data->name = $request->post('size_name');
        $data->sub_category_id = $request->post('subCategory');
    }
}