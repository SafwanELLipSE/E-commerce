<?php

namespace App\Http\Repository\Subcategory;

use App\Models\Sub_Category;
use Illuminate\Support\Facades\Auth;

class SubcategoryRepository implements SubcategoryInterface
{
    public function all()
    {
        return Sub_Category::paginate(25);
    }
    public function get($id)
    {
        return Sub_Category::find($id);
    }
    public function store($request)
    {
    }
    public function update($request, $id)
    {
    }
    public function delete($id)
    {
    }
}
