<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function list(){
        $data['getRecord'] = User::getAdmin();
        $data['header_title'] = "Admin List";
        return view('admin.admin.list', $data);
    }


    public function add(){
        $data['header_title'] = "Add New Admin";
        return view('admin.admin.add', $data);
    }


    public function insert(Request $request){

        // email validation to prevent duplication
        request()->validate([
            'email'=>'required|unique:users'
        ]);

        $user = new User;
        $user-> name = trim($request->name);
        $user-> email = trim($request->email);
        $user-> password = Hash::make($request->password);
        $user -> user_type = 1;
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;

            $file->move('upload/profile', $filename);

            $user->profile_pic = $filename;
        }
        $user->save();

        return redirect('admin/admin/list')->with('success', "Admin successfully added.");
    }

    public function edit($id){
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Admin";
            return view('admin.admin.edit', $data);
        }else{
            abort(404);
        }
    }


    public function update($id, Request $request){
        request()->validate([
            'email'=>'required|unique:users,email,'.$id
        ]);

        $user = User::getSingle($id);
        $user-> name = trim($request->name);
        $user-> email = trim($request->email);
        if(!empty($request->password)){
            $user-> password = Hash::make($request->password);
        }
        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;

            $file->move('upload/profile', $filename);

            $user->profile_pic = $filename;
        }

        $user->save();

        return redirect('admin/admin/list')->with('success', "Admin successfully Updated.");
    }


    public function delete($id){
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();

        return redirect('admin/admin/list')->with('success', "Admin successfully Deleted.");
    }
}
