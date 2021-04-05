<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Color\ColorInterface;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function __construct(ColorInterface $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }
    public function index()
    {
        //
    }
    public function storeColor(Request $request)
    {
        $this->colorRepository->store($request);
        return redirect()->back();
    }
    public function allColorList(Request $request)
    {
        echo json_encode($this->colorRepository->list($request));
    }
    public function editColor(Request $request, $id)
    {
        return view('backend.features.color_edit', [
            'color' => $this->colorRepository->get($id)
        ]);
    }
    public function updateColor(Request $request)
    {
        $id = $request->post('color_id');
        $this->colorRepository->update($request, $id);
        return redirect()->back();
    }
    public function destroyColor(Request $request)
    {
        $this->colorRepository->delete($request, $request->post('id'));
        return response()->json("Successfully, Color has been deleted", 200);
    }
}
