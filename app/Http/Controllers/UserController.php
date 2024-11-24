<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  public function viewlog(){
    return view('auth.login');
  }
  public function viewregister(){
    return view('auth.register');
  }
  public function register(Request $request){
    // Validate the request data
     $request->validate([
      'FirstName' => 'required|string|max:255',
      'LastName' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'mobileNumber' => 'required|digits:10',
      'password' => 'required|string|min:8|confirmed',
  ]);
  // $user=User::create($data);

  $user = User::create([
      'FirstName' => $request->FirstName,
      'LastName' => $request->LastName,
      'email' => $request->email,
      'mobileNumber' => $request->mobileNumber,
      'password' => $request->password
      
  ]);
  if ($user) {
    $defaultRole = Role::where('roleName', 'customer')->first();
    if ($defaultRole) {
        $user->roles()->attach($defaultRole->id);
    }

    return redirect()->route('login')->with('success', 'User registered successfully.');
}

// Handle if the user creation fails
return back()->with('error', 'Failed to register the user.');
}



 public function Login(Request $request){
  $credentials=$request->validate([
    'email'=>'required',
    'password'=>'required'
  ]);
  if (Auth::attempt($credentials)) {
    return redirect()->route('dashboardPage');
    }
 }

 public function dashboardPage(){
 
    return view('admin.index');
  
 }
 public function logout(){
  Auth::logout();
  return view('welcome');
 }

 public function manageAdmins()
{
    // Get all admins and customers
    $admins = User::whereHas('roles', function ($query) {
        $query->where('roleName', 'admin');
    })->get();
    
    $customers = User::whereDoesntHave('roles')->orWhereHas('roles', function ($query) {
        $query->where('roleName', '!=', 'admin');
    })->get();

    return view('admin.manage', compact('admins', 'customers'));
}

public function assignRole(Request $request)
{
    $user = User::find($request->user_id);
    $role = Role::where('roleName', 'admin')->first();

    if ($user && $role) {
        // Directly set the role_id for the user
        $user->role()->updateOrCreate([], ['role_id' => $role->id]);
    }

    return redirect()->route('admin.manage')->with('success', 'Role assigned successfully.');

  }
  public function index(){
    $user = User::whereDoesntHave('roles', function ($query) {
      $query->where('roleName', 'admin');
  })->get();
    return view('user.index',compact('user'));
  }

}