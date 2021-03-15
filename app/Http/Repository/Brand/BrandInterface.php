<?php

namespace App\Http\Repository\Brand;

interface BrandInterface{
    public function all();
    public function get($id);
    public function store(array $data);
    public function update($id, array $data);
    public function delete($id);
}