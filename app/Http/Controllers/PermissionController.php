<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PermissionController extends Controller //implements HasMiddleware
{
  public static function middleware():array
  {
    return [
      new Middleware('permission:view permissions', only:['index']),
      new Middleware('permission:edit permissions', only:['edit']),
      new Middleware('permission:create permissions', only:['create']),
      new Middleware('permission:delete permissions', only:['destroy']),
    ];
  }
  public function index()
  {
    $permissions = Permission::orderBy('created_at', 'DESC')->paginate(25);
    return view('permissions.list', ['permissions' => $permissions]);
  }

  public function create()
  {
    return view('permissions.create');
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(),[
      'name' => 'required|unique:permissions|min:3',
    ]);

    if ($validator->passes())
    {
      Permission::create(['name' => $request->name]);

      return redirect()->route('permissions.index')->with('success', 'Permission added successfully.');

    }else{
      return redirect()->route('permissions.create')->withInput()->withErrors($validator);
    }
  }

  public function edit($id)
  {
    $permission = Permission::findOrFail($id);
    return view('permissions.edit', ['permission' => $permission]);
  }

  public function update(request $request,$id)
  {
    $permission = Permission::findOrFail($id);

    $validator = Validator::make($request->all(), [
      'name' => 'required|unique:permissions,name,'.$id.',id'
    ]);

    if($validator->passes())
    {
      $permission->name = $request->name;
      $permission->save();
      return redirect()->route('permissions.index')->with('success', 'Permission has been updated successfully');
    }else {
      return redirect()->route('permissions.edit')->withInput()->withErrors($validator);
    }
  }

  public function destroy(Request $request)
  {
    $id = $request->id;
    $permission = Permission::find($id);
    if($permission == null) {
      session()->flash('error', 'Permission not found');
      return response()->json([
        'status' => false,
      ]);
    }
    $permission->delete();
    session()->flash('success', 'Permission deleted successfully.');
    return response()->json([
      'status' => true
    ]);

  }
}
