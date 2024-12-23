<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get();
        
        return view('roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name']
        ]);

        Role::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        return redirect()->back()->with('status', 'Role created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('roles.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name,$role']
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('status', 'Role updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $userRole = DB::table('model_has_roles')
                        ->where('role_id', $role->id)
                        ->first();

        if ($userRole){
            return redirect()->route('roles.index')->with('status', 'The role cannot be deleted, it has related record.');
            exit();
        }

        $role->delete();

        return redirect()->route('roles.index')->with('status', 'Role deleted.');
    }
}