<?php

namespace App\Http\Repository\ProductSlider;

interface ProductSliderInterface
{
    public function get($id);
    public function store($request);
    public function update($request);
    public function delete($request);
}
