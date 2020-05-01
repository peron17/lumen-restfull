<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller {

    public function index()
    {
        $model = Post::all();
        return response()->json(['data' => $model], 200);
    }

}