<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $role = Role::get();
            if ($request->name) {
                $role = Role::where('name', 'like', "%{$request->name}%")->get();
            }
            return response()->json(['status' => true, 'message' => '', 'data' => $role]);
        } else {
            abort(403);
        }
    }

    public function role(Request $request)
    {
        $role = Role::findById($request->id);
        return response()->json($role->name);
    }
}
