<?php

namespace App\Http\Repository\Brand;

interface BrandInterface{
    public function all();
    public function get($id);
    public function store($request);
    public function update($request, $id);
    public function delete($id);
}