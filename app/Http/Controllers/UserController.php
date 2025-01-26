<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')->join('branches', 'users.branch_id', '=', 'branches.id')
                                   ->select('users.id', 'users.name', 'users.profile_photo_path', 'users.email', 'branches.branch_name')
                                   ->orderBy('name')
                                   ->paginate(25);
                                   
        return view('user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::orderBy('branch_name')->get();
        $roles = Role::pluck('name', 'name')->all();

        return view('user.create', [
            'branches' => $branches,
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'unique:users', 'email'],
            'branch' => ['required'],
            'role' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('Password1234'),
            'branch_id' => $request->branch,
            'is_system' => false,
            'is_active' => true
        ]);

        $user->syncRoles($request->role);

        return redirect(route('user.create'))->with('success', 'New user added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = User::where('users.id', $id)
                                   ->join('branches', 'users.branch_id', '=', 'branches.id')
                                   ->select('users.id', 'name', 'email', 'branch_name', 'is_active', 'users.created_at', 'users.updated_at')
                                   ->first();
                                   
        return view('user.show')->with('user', $users);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        
        $users = DB::table('users')->where('users.id', $user->id)
                                   ->join('branches', 'users.branch_id', '=', 'branches.id')
                                   ->select('users.id', 'name', 'email','branch_id', 'branch_name', 'is_active')
                                   ->first();

        $branches = Branch::orderBy('branch_name')->get();
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
 
        return view('user.edit', [
            'user' => $users,
            'branches' => $branches,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        request()->validate([
            'name' => ['required', 'string'],
            'email' => ['required', Rule::unique('users')->ignore($user)],
            'role' => ['required']
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'branch_id' => $request->branch,
            'is_active' => $request->is_active,
        ]);

        $user->syncRoles($request->role);

        return redirect('/user/' . $user->id)->with('status', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $userRole = DB::table('model_has_roles')
                        ->where('model_id', $user->id)
                        ->first();

        if (Auth()->user()->id !== $user->id) 
        {
            $user->delete();
            return redirect(route('user.index'))->with('status' , 'Record deleted successfully');
        }  
        else
        {  
            return redirect('/abort');
        }

    }

    #use ajax to search record in users
    public function fetch(Request $request)
    {
        $search = $request->id;

        $users = DB::table('users')->join('branches', 'users.branch_id', '=', 'branches.id')
                                   ->select('users.id', 'users.name', 'users.profile_photo_path', 'users.email', 'branches.branch_name')
                                   ->whereAny([
                                    'name',
                                    'email'
                                   ], 'LIKE', '%'.$search.'%')
                                   ->orderBy('name')
                                   ->paginate(25);

        if ($request->ajax()){
            return view('user.fetch')->with('users', $users);
        }

        return view('user.index')->with('users', $users);
    }
}