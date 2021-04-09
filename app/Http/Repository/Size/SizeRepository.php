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
        $creatorSize = Size::distinct('creator')->count();

        return [
            'totalSize' => $totalSize,
            'activeSize' => $activeSize,
            'inactiveSize' => $inactiveSize,
            'creatorSize' => $creatorSize
        ];
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
        $size->creator = Auth::user()->id;
        $size->save();
        Alert::success('Success', 'Successfully Created a new Size');
    }
    public function list($request)
    {
        $sizes = $this->all();
        if ($request->post('status')) {
            $sizes = Size::where('status', $request->post('status'))->get();
        }
        if ($request->post('subCategory')) {
            $sizes = Size::where('sub_category_id', $request->post('subCategory'))->get();
        }
        $totalData = $sizes->count();
        $totalFiltered = $totalData;
        $toReturn = array();

        foreach ($sizes as $size) {
            $show = route('customize.size.edit', $size->id);
            $status_link = route('customize.size.status', $size->id);
            $status_icon = $size->status != 1 ? "fa-check" : "fa-times";
            $status_color = $size->status != 1 ? "btn-success" : "btn-danger";
            $localArray[0] = $size->id;
            $localArray[1] = $size->measurement;
            $localArray[2] = $size->unit;
            $localArray[3] = $size->subCategory->name;
            $localArray[4] = Size::getStatus($size->status);
            $localArray[5] = Auth::User($size->creator)->name;
            $localArray[6] = $size->created_at->format('d.m.Y');
            $localArray[7] = "<a href='{$show}' class='btn btn-sm btn-info'><i class='fas fa-user-edit'></i></a> <a href='{$status_link}' class='btn btn-sm {$status_color}'><i class='fas {$status_icon}'></i></a> <div class='btn btn-sm btn-warning' id='delete-size' data-size-id='{$size->id}'><i class='fas fa-trash-alt text-light'></i></div>";
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
        $size = $this->get($id);
        if ($size->status == Size::ACTIVE) {
            $size->status = Size::INACTIVE;
        } elseif ($size->status == Size::INACTIVE) {
            $size->status = Size::ACTIVE;
        }
        $size->save();
        Alert::success('Success', 'Successfully Status of Size has been changed.');
    }
    private function validationSize($request)
    {
        return Validator::make($request->all(), [
            'size'   => 'required',
            'sub_category' => 'required',
            'unit' => 'required',
        ]);
    }
    private function saveInformation($data, $request)
    {
        $data->measurement = $request->post('size');
        $data->sub_category_id = $request->post('sub_category');
        $data->unit = $request->post('unit');
    }
}