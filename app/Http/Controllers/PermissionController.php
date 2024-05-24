<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //

    public function index(Request $request)
    {
        $permissions = Permission::with('user')->when($request->input('name'), function ($query, $name) {
            $query->whereHas('user', function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        })->orderBy('id', 'desc')->paginate(10);

        return view('pages.permission.index', ['permissions' => $permissions]);
    }

    //delete
    public function destroy($id)
    {
        try {
            //code...
            $permission = Permission::findOrFail($id);
            $permission->delete();
            return response()->json(["message" => "Permission deleted"], 200);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(["message" => $e->getMessage()], $e->getCode());
        }
    }

    //show
    public function show($id)
    {
        $permission = Permission::with('user')->findOrFail($id);
        return view('pages.permission.show', ['permission' => $permission]);
    }

    //is_approved
    public function is_approved(Request $request, $id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->is_approved = $request->is_approved;
            $permission->save();
            return response()->json(["message" => "Permission approved"], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], $e->getCode());
        }
    }
}
