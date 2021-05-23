<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Discount\DiscountInterface;
use App\Http\Repository\Product\ProductInterface;

class DiscountController extends Controller
{
    public function __construct(DiscountInterface $discountRepository, ProductInterface $productRepository)
    {
        $this->discountRepository = $discountRepository;
        $this->productRepository = $productRepository;
    }
    public function index(Request $request)
    {
        return view('backend.discounts.discount_index', [
            'products' => $this->productRepository->all(),
        ]);
    }
    public function storeDiscount(Request $request)
    {
        $this->discountRepository->store($request);
        return redirect()->back();
    }
    public function displayDiscountList(Request $request)
    {
        return view('backend.discounts.discount_list');
    }
    public function allDiscountList(Request $request)
    {
        echo json_encode($this->discountRepository->list($request));
    }
    public function editDiscount(Request $request, $id)
    {
        return view('backend.discounts.discount_edit', [
            'discount' => $this->discountRepository->get($id),
            'products' => $this->productRepository->all(),
        ]);
    }
    public function updateDiscount(Request $request)
    {
        $id = $request->post('discount_id');
        $this->discountRepository->update($request, $id);
        return redirect()->back();
    }
    public function destroyDiscount(Request $request)
    {
        $this->discountRepository->delete($request, $request->post('id'));
        return response()->json("Successfully, Category has been deleted", 200);
    }
    public function deleteSelectedDiscount(Request $request)
    {
        $discount_id_array = $request->input('id');
        $this->discountRepository->selectedDelete($request, $discount_id_array);
        return response()->json("Successfully, Discounts has been deleted", 200);
    }
    public function deleteAllDiscount(Request $request)
    {
        $this->discountRepository->deleteAll($request);
        return response()->json("Successfully, All Discounts has been deleted", 200);
    }
}
