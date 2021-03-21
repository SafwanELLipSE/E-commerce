<?php

namespace App\Http\Repository\Subcategory;

interface SubcategoryInterface
{
    public function all();
    public function get($id);
    public function store($request);
    public function update($request, $id);
    public function delete($request,$id);
    public function status($request,$id);
}
