<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Repository\Subcategory\SubcategoryInterface;
use App\Http\Repository\Category\CategoryInterface;

class SubCategoryController extends Controller
{
    public function __construct(SubcategoryInterface $subCategoryRepository, CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
    }
    public function index(Request $request)
    {
        return view('backend.subCategory.subCategory_index',[
            'categories' => $this->categoryRepository->all()
        ]);
    }
}
