<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Intervention\Image\Facades\Image as Image;

class ItemController extends Controller
{
    public function index()
    {
        return Item::all();
    }
 
    public function show($id)
    {
        return Item::find($id);
    }

    public function store(Request $request)
    {
        return Item::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());

        return $item;
    }

    public function delete(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return 204;
    }


    public function upload(Request $request) {
        $data = $request->all();
        $png_url = $data['prefix']."-".time().".png";
        $path = public_path().'/img/' . $png_url;
    
        Image::make(file_get_contents($data['img']))->save($path);     
        return ['file' => $png_url];
     }
}
