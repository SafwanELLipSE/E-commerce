<?php

namespace App\Http\Repository\Stock;

interface StockInterface
{
    public function all();
    public function get($id);
    public function count();
    public function store($request);
    public function list($request);
    public function restock($request, $id);
    public function stockIn($request, $id);
    public function stockOut($request, $id);
    public function update($request, $id);
    public function delete($request, $id);
    public function selectedDelete($request, $id);
    public function deleteAll($request);
}
