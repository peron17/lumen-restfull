<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function index()
    {
        $model = User::all();
        return response()->json(['data' => $model], 200);
    }

    public function store(Request $request)
    {
        # code...
    }

    public function show($id)
    {
        # code...
    }

    public function update(Request $request, $id)
    {
        # code...
    }

    public function destroy($id)
    {
        # code...
    }

}