<?php

namespace App\Http\Repository\Feature;

interface FeatureInterface{
    public function all();
    public function get($id);
    public function count();
    public function list($request);
    public function store($request);
    public function update($request, $id);
    public function delete($request, $id);
    public function selectedDelete($request, $id);
    public function deleteAll($request);
}