<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {

    public function index()
    {
        $model = User::all();
        return response()->json(['data' => $model], 200);
    }

    public function store(Request $request)
    {
        $this->validation($request);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        if ($model = User::create($data)) $this->success($model, 200);
        else $this->error(null, 500);
    }

    public function show($id)
    {
        $model = User::find($id);
        if ($model) $this->success($model, 200);
        else $this->error('Data not found', 500);
    }

    public function update(Request $request, $id)
    {
        $model = User::find($id);
        
        if (!$model)
            $this->error('User not found', 404);

        $this->validation($request);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->password)
            $data = array_merge($data, ['password' => Hash::make($request->password)]);

        if ($model->update($data)) $this->success($model, 200);
        else $this->error(null, 500);
    }

    public function destroy($id)
    {
        $model = User::find($id);
        
        if (!$model)
            $this->error('User not found', 404);

        if ($model->delete()) $this->success(null, 200);
        else $this->error(null, 500);
    }

    protected function validation($request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
    }

}