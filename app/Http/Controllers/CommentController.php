<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Optimus\Bruno\EloquentBuilderTrait;
use Optimus\Bruno\LaravelController;

use Auth;

class CommentController extends LaravelController
{
    use EloquentBuilderTrait;

    public function index()
    {
        // Parse the resource options given by GET parameters
        $resourceOptions = $this->parseResourceOptions();

        // Start a new query for books using Eloquent query builder
        // (This would normally live somewhere else, e.g. in a Repository)
        $query = Comment::query();
        $this->applyResourceOptions($query, $resourceOptions);
        $books = $query->get();
        return $books;
        // Parse the data using Optimus\Architect
        $parsedData = $this->parseData($books, $resourceOptions, 'Comment');
        // Create JSON response of parsed data
        return $this->response($parsedData);
    }
 
    public function show($id)
    {
        return Comment::find($id);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::guard('api')->id();
        return Comment::create($data);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return $comment;
    }

    public function delete(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return 204;
    }
}
