<?php

namespace App\Http\Repository\Brand;

interface BrandInterface{
    public function all();
    public function list($request);
    public function get($id);
    public function store($request);
    public function update($request, $id);
    public function delete($request, $id);
    public function status($request, $id);
}