<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SupportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderby('id', 'DESC')->get();
        return view('users/list', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        $perms = Permission::all();
        return view('users/new', [
            'roles' => $roles,
            'perms' => $perms,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'uname' => 'required|string|max:20|min:2|unique:users,uname',
            'fname' => 'nullable|string|max:50|min:3',
            'lname' => 'nullable|string|max:50|min:3',
            'password' => 'nullable|string|max:50|min:6',
            'password2' => 'nullable|string|max:50|min:6|same:password',
            'job_position' => 'nullable|string|max:20|min:2',
            'role' => 'nullable|string|max:20|min:2|exists:roles,name',
            'perm' => 'nullable|array|min:1',
            'perm.*' => 'required|string|max:20|min:2|exists:permissions,name',
        ]);
        
        $user = new User();
        $user->uname = $request->uname;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->password = bcrypt($request->password);
        $user->job_position = $request->job_position;
        $user->active = 1;
        $user->save();
        if($request->role != null)
            $user->assignRole($request->role);
        if($request->perm != null)
            foreach($request->perm as $perm)
                $user->givePermissionTo($perm);

        return redirect(route('usersList'))->with('status', 'پروفایل مورد نظر با موفقیت ایجاد شد.');
    }

    public function createRole()
    {
        $perms = Permission::all();
        return view('users/newRole', [
            'perms' => $perms,
        ]);
    }

    public function storeRole(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:20|min:2|unique:roles,name',
            'perm' => 'required|array|min:1',
            'perm.*' => 'required|string|max:20|min:2|exists:permissions,name',
        ]);
        $role = Role::create(['name' => $request->name]);

        foreach($request->perm as $perm)
            // $permission = Permission::create(['name' => $perm]);
            $role->givePermissionTo($perm);

        return redirect(route('usersList'))->with('status', 'نقش کاربری مورد نظر با موفقیت ایجاد شد.');
    }

    public function profile()
    {
        $requests = SupportRequest::with('customer','category','user')->where('user_id', Auth::User()->id)->orderby('id', 'DESC')->take(5)->get();
        return view('users.profile', [
            'user' => Auth::user(),
            'requests' => $requests
        ]);
    }  

    public function profileStore(Request $request)
    {
        $validated = $request->validate([
            'uname' => 'required|string|max:20|min:2|unique:users,uname,'. Auth::User()->id,
            'fname' => 'nullable|string|max:50|min:3',
            'lname' => 'nullable|string|max:50|min:3',
            'password' => 'nullable|string|max:50|min:6',
            'password2' => 'nullable|string|max:50|min:6|same:password',
            // 'job_position' => 'nullable|string|max:20|min:3',
        ]);
        
            
        User::where('id', Auth::User()->id)->update([
            'uname'=> $request->uname,
            'fname'=> $request->fname,
            'lname'=> $request->lname
        ]);
        if($request->password != null)
            User::where('id', Auth::User()->id)->update([
                'password'=> bcrypt($request->password)
            ]);
        return redirect(route('userProfile'))->with('status', 'پروفایل مورد نظر با موفقیت ویرایش شد.');
    }

    public function update(Request $request, $id)
    {
        if($id == null)
            return redirect(route('usersList'))->with('statusErr', 'برای ویرایش باید یک پروفایل انتخاب کرده باشید.');

        $validated = $request->validate([
            'uname' => 'required|string|max:20|min:2|unique:users,uname,'. $id,
            'fname' => 'nullable|string|max:50|min:3',
            'lname' => 'nullable|string|max:50|min:3',
            'password' => 'nullable|string|max:50|min:6',
            'password2' => 'nullable|string|max:50|min:6|same:password',
            'job_position' => 'nullable|string|max:20|min:2',
        ]);
        
        
        $user = User::where('id', $id)->first();
        if($user == null)
            return redirect(route('usersList'))->with('statusErr', 'پروفایل مورد نظر یافت نشد.');
            
            
        User::where('id', $id)->update([
            'uname'=> $request->uname,
            'fname'=> $request->fname,
            'lname'=> $request->lname,
            'job_position'=> $request->job_position
        ]);
        if($request->password != null)
            User::where('id', $id)->update([
                'password'=> bcrypt($request->password)
            ]);
        return redirect(route('usersList'))->with('status', 'پروفایل مورد نظر با موفقیت ویرایش شد.');
    }

    public function destroy($id)
    {
        if($id == null)
            return redirect(route('usersList'))->with('statusErr', 'برای حذف باید یک پروفایل انتخاب کرده باشید.');

        $user = User::where('id', $id)->first();
        if($user == null)
            return redirect(route('usersList'))->with('statusErr', 'پروفایل مورد نظر یافت نشد.');
            
        User::where('id', $id)->delete();
        return redirect(route('usersList'))->with('status', 'پروفایل مورد نظر با موفقیت حذف شد.');
    }

    public function updateStatus($id)
    {
        if($id == null)
            return redirect(route('usersList'))->with('statusErr', 'برای ویرایش باید یک پروفایل انتخاب کرده باشید.');

        $user = User::where('id', $id)->first();
        if($user == null)
            return redirect(route('usersList'))->with('statusErr', 'پروفایل مورد نظر یافت نشد.');
            
        User::where('id', $id)->update([
                'active'=> ($user->active ^ 1)
            ]);
        return redirect(route('usersList'))->with('status', 'پروفایل مورد نظر با موفقیت ویرایش شد.');
    }

    public function show($id)
    {
        if($id == null)
            return redirect(route('usersList'))->with('statusErr', 'برای مشاهده باید یک پروفایل انتخاب کرده باشید.');

        $user = User::where('id', $id)->first();
        if($user == null)
            return redirect(route('usersList'))->with('statusErr', 'پروفایل مورد نظر یافت نشد.');
        
        $requests = SupportRequest::with('customer','category','user')->where('user_id', $id)->orderby('id', 'DESC')->take(10)->get();
        return view('users/profile', [
            'user' => $user,
            'requests' => $requests,
        ]);
    }

    // public function update(Request $request, $id)
    // {
    //     if($id == null)
    //         return redirect(route('usersList'))->with('statusErr', 'برای ویرایش باید یک پروفایل انتخاب کرده باشید.');

    //     $validated = $request->validate([
    //         'title' => 'nullable|string|max:50|min:4',
    //         'callername' => 'nullable|string|max:50|min:3',
    //         'callertell' => 'nullable|string|max:50|min:3',
    //         'desc' => 'nullable|string|max:255|min:3',
    //     ]);
        
    //     $contract = User::where('id', $id)->first();
    //     if($contract == null)
    //         return redirect(route('usersList'))->with('statusErr', 'پروفایل مورد نظر یافت نشد.');
            
    //     User::where('id', $id)->update([
    //         'title'=> $request->title,
    //         'callername'=> $request->callername,
    //         'callertell'=> $request->callertell,
    //         'desc'=> $request->desc,
    //     ]);
    //     return redirect(route('usersList'))->with('status', 'پروفایل مورد نظر با موفقیت ویرایش شد.');
    // }
}
