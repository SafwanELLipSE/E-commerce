<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\ProductSlider\ProductSliderInterface;
use Illuminate\Http\Request;

class ProductSliderImageController extends Controller
{
    public function __construct(ProductSliderInterface $productSliderRepository)
    {
        $this->productSliderRepository = $productSliderRepository;
    }
    public function index(Request $request, $id)
    {
        return view('backend.products.product_image_slider', [
            'productImages' => $this->productSliderRepository->get($id),
            'productID' => $id,
        ]);
    }
    public function storeImage(Request $request)
    {
        $this->productSliderRepository->store($request);
        return redirect()->back();
    }
    public function updateImage(Request $request)
    {
        $this->productSliderRepository->update($request);
        return redirect()->back();
    }
    public function destroyImage(Request $request)
    {
        $this->productSliderRepository->delete($request);
        return redirect()->back();
    }
}
