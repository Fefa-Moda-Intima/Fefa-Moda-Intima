<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    function register(Request $request)
    {
        $role = new Role;
        $role->role_name = $request->role_name;
        $role->description = $request->description;

        $role->save();

        return response()->json(["msg" => "Permissão cadastrada com sucesso!", "data" => $role], 201);
    } 
}
