<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use App\Item;
use Optimus\Bruno\EloquentBuilderTrait;
use Optimus\Bruno\LaravelController;
use Auth;

class ItemController extends LaravelController
{
    use EloquentBuilderTrait;

    public function index()
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        // Start a new query for books using Eloquent query builder
        // (This would normally live somewhere else, e.g. in a Repository)
        $query = Item::query();
        $this->applyResourceOptions($query, $resourceOptions);
        $books = $query->get();
        return $books;
        // Parse the data using Optimus\Architect
        $parsedData = $this->parseData($books, $resourceOptions, 'Item');
        // Create JSON response of parsed data
        return $this->response($parsedData);
    }
 
    public function show($id)
    {
        return Item::find($id);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::guard('api')->id();
        return Item::create($data);
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
