<?php

namespace App\Http\Repository\Category;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryRepository implements CategoryInterface{
    public function all(){
        return Category::paginate(25);
    }
    public function get($id){
        return Category::find($id);
    }
    public function store($request){

    }
    public function update($request, $id){

    }
    public function delete($id){
        
    }
}