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

        return view('user.create')->with('branches', $branches);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'unique:users', 'email']
        ]);

        $users = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('Password1234'),
            'branch_id' => $request->branch,
            'is_system' => false,
            'is_active' => true
        ]);

        return redirect(route('user.create'))->with('success', 'New user added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = DB::table('users')->where('users.id', $id)
                                   ->join('branches', 'users.branch_id', '=', 'branches.id')
                                   ->select('users.id', 'name', 'email', 'branch_name', 'is_active', 'users.created_at', 'users.updated_at')
                                   ->first();
                                   
        return view('user.show')->with('user', $users);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $users = DB::table('users')->where('users.id', $id)
                                   ->join('branches', 'users.branch_id', '=', 'branches.id')
                                   ->select('users.id', 'name', 'email','branch_id', 'branch_name', 'is_active')
                                   ->first();

        $branches = Branch::where('id', '<>', $users->branch_id)
                            ->orderBy('branch_name')->get();

        return view('user.edit')->with('user', $users)->with('branches', $branches);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        request()->validate([
            'name' => ['required', 'string'],
            'email' => ['required', Rule::unique('users')->ignore($user)]
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'branch_id' => $request->branch,
            'is_active' => $request->is_active,
        ]);

        return redirect('/user/' . $user->id)->with('status', 'Record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
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