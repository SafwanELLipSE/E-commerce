<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Brand\BrandRepository;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(BrandRepository $brandRepository){
        $this->brandRepository = $brandRepository;
    }
    public function index(Request $request)
    {
        return view('backend.brands.brand_index');
    }
}
