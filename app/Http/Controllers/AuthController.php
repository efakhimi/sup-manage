<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AuthController extends Controller
{
    public function index()
    {
        // $role = Role::create(['name' => 'Administrator']);
        // $perms = [
        //     'view_category',
        //     'create_category',
        //     'edit_category',
        //     'delete_category',
        //     'view_customer',
        //     'create_customer',
        //     'edit_customer',
        //     'delete_customer',
        //     'view_contract',
        //     'create_contract',
        //     'edit_contract',
        //     'delete_contract',
        //     'view_suprequest',
        //     'create_suprequest',
        //     'edit_suprequest',
        //     'delete_suprequest',
        //     'edit_suprequest_all',
        //     'delete_suprequest_all',
        //     'view_user',
        //     'create_user',
        //     'edit_user',
        //     'delete_user',
        // ];
        // foreach($perms as $perm)
        // {
        //     $permission = Permission::create(['name' => $perm]);
        //     $role->givePermissionTo($permission);
        // }
        // $role = Role::findByName('Administrator');
        // $perms = [
        //     'create_roles',
        //     'manipulate_permrole',
        // ];
        // foreach($perms as $perm)
        // {
        //     $permission = Permission::create(['name' => $perm]);
        //     $role->givePermissionTo($permission);
        // }
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'uname' => 'required|exists:users,uname',
            'password' => 'required',
        ]);
        $user = User::where('uname', $request->uname)->first();
        // dd($user);
        if($user->active == 0)
            return redirect("login")->with('error', 'حساب کاربری شما مسدود شده است.');

        $credentials = $request->only('uname', 'password');
        if (Auth::attempt($credentials)) {
            User::where('uname', $request->uname)->update(['last_login' => date("Y/m/d H:i")]);
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->with('error', 'رمز عبور صحیح نیست.');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    
    public function dashboard()
    {
        // if(Auth::check()){
            return view('dashboard');
        // }
  
        // return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
