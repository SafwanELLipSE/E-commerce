<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.category.category_index');
    }
    public function storeCategory(Request $request){

    }
    public function editCategory(Request $request){

    }
    public function updateCategory(Request $request){
        
    }
    public function destroyCategory(Request $request){
        
    }
}
