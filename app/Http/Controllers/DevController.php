<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dev;

class DevController extends Controller
{
    public function show()
    {
        $devs = Dev::all();
        return $this->successResponse($devs);
    }

    public function detail($id)
    {
        $dev = Dev::findOrFail($id)->toJson(JSON_PRETTY_PRINT);
        return response($dev, 200);
    }

    public function register(Request $request)
    {
        $dev = new Dev;
        $dev->name = $request->name;
        $dev->save();
        return response()->json(["msg" => "Dev criado com sucesso!"], 201);
    }

    public function update(Request $request, $id)
    {
        $dev = $request->all();
        $dev = Dev::findOrFail($id)->update($dev);
        return response()->json(["msg" => "Dev atualizado com sucesso!"], 200);
    }

    public function destroy($id)
    {
        Dev::findOrFail($id)->delete();
        return response()->json(["msg" => "Dev deletado com sucesso!"], 200);
    }
}
