<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Brand\BrandInterface;
use App\Http\Repository\Category\CategoryInterface;
use App\Http\Repository\Product\ProductInterface;
use App\Http\Repository\Feature\FeatureInterface;
use App\Http\Repository\Subcategory\SubcategoryInterface;
use App\Http\Repository\Color\ColorInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(CategoryInterface $categoryRepository, BrandInterface $brandRepository, SubcategoryInterface $subCategoryRepository, ProductInterface $productRepository, FeatureInterface $featureRepository, ColorInterface $colorRepository)
    {
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->featureRepository = $featureRepository;
        $this->colorRepository = $colorRepository;
        $this->productRepository = $productRepository;

    }
    public function index(Request $request)
    {
        return view('backend.products.product_index', [
            'brands' => $this->brandRepository->all(),
            'categories' => $this->categoryRepository->all(),
            'subCategories' => $this->subCategoryRepository->all(),
            'features' => $this->featureRepository->all(),
            'colors' => $this->colorRepository->all(),
        ]);
    }
    public function storeProduct(Request $request)
    {
        $this->productRepository->store($request);
        return redirect()->back();
    }
    public function displayProductList(Request $request){
        return view('backend.products.product_list', [
            'brands' => $this->brandRepository->all(),
            'categories' => $this->categoryRepository->all(),
            'subCategories' => $this->subCategoryRepository->all(),
        ]);
    }
    public function allProductList(Request $request)
    {
        echo json_encode($this->productRepository->list($request));
    }
    public function displayProduct(Request $request, $id){
        return view('backend.products.product_display', [
            'product' => $this->productRepository->get($id),
        ]);
    }
    public function editProduct(Request $request, $id)
    {
        return view('backend.products.product_edit', [
            'brands' => $this->brandRepository->all(),
            'categories' => $this->categoryRepository->all(),
            'subCategories' => $this->subCategoryRepository->all(),
            'features' => $this->featureRepository->all(),
            'colors' => $this->colorRepository->all(),
            'product' => $this->productRepository->get($id),
        ]);
    }
    public function updateProduct(Request $request)
    {
        $id = $request->post('product_id');
        $this->productRepository->update($request, $id);
        return redirect()->back();
    }
    public function destroyProduct(Request $request)
    {
        $this->productRepository->delete($request, $request->post('id'));
        return response()->json("Successfully, Product has been deleted", 200);
    }
}
