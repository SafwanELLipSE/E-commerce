<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Brand\BrandInterface;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(BrandInterface $brandRepository){
        $this->brandRepository = $brandRepository;
    }
    public function index(Request $request)
    {
        return view('backend.brands.brand_index');
    }
    public function storeBrand(Request $request)
    {
        $this->brandRepository->store($request);
        return view('backend.brands.brand_index');
    }
}
