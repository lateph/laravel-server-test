<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all()->map(function ($item) {
            $item->profilePics = json_decode($item->profilePics, true);
            return $item;
        });
    }
 
    public function show($id)
    {
        return Category::find($id);
    }

    public function store(Request $request)
    {
        return Category::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $item = Category::findOrFail($id);
        $item->update($request->all());

        return $item;
    }

    public function delete(Request $request, $id)
    {
        $item = Category::findOrFail($id);
        $item->delete();

        return 204;
    }
    
    public function home(){
        return Category::where(['home'=>1])->limit(5)->get()->map(function ($category) {
            $category->profilePics = json_decode($category->profilePics, true);
            $category->items = $category->items()->limit(10)->get()->map(function($item){
                $item->user = $item->user;
                return $item;
            });
            return $category;
        });
    }
}
