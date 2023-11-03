<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class TeacherController extends Controller
{
    public function list(){

        $data['getRecord'] = User::getTeacher();
        $data['header_title'] = "Teacher List";
        return view('admin/teacher/list', $data);
    }

    public static function add(){
        // $data['getRecord'] = User::getTeacher();
        $data['header_title'] = "Add New Teacher";
        return view('admin.teacher.add', $data);
    }

    public function edit($id){

        $data['getRecord'] = User::getSingle($id);

        if(!empty($data['getRecord'])){

            $data['header_title'] = "Edit Teacher";
            return view('admin.teacher.edit', $data);
        }
        else{
            abort(404);
        }

    }

    public static function insert(Request $request){
        request()->validate([
            'email' => 'required | email|unique:users'
        ]);

        $teacher =  new User;
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        $teacher->address = trim($request->address);
        $teacher->qualification = trim($request->qualification);
        $teacher->experience = trim($request->experience);
        $teacher->address = trim($request->address);
        $teacher->mobile_number = trim($request->mobile_number);


        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;

            $file->move('upload/profile', $filename);

            $teacher->profile_pic = $filename;
        }

        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password =  Hash::make($request->password);
        $teacher -> occupation = "Teacher";
        $teacher->user_type = 2;
        $teacher ->save();

        return redirect('admin/teacher/list')->with('success', "Teacher Successfully Registered");

    }

    public function update($id, Request $request){
        request()->validate([
            'email' => 'required | email|unique:users,email,'.$id
        ]);

        $teacher =  User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);
        $teacher->address = trim($request->address);
        $teacher->qualification = trim($request->qualification);
        $teacher->experience = trim($request->experience);
        $teacher->address = trim($request->address);
        $teacher->mobile_number = trim($request->mobile_number);


        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;

            $file->move('upload/profile', $filename);

            $teacher->profile_pic = $filename;
        }

        $teacher->status = trim($request->status);
        $teacher->email = trim($request->email);
        $teacher->password =  Hash::make($request->password);
        $teacher -> occupation = "Teacher";
        $teacher->user_type = 2;
        $teacher ->save();

        return redirect('admin/teacher/list')->with('success', "Teacher Successfully Registered");
    }

    public function delete($id){
        $getRecord = User::getSingle($id);

        if(!empty('getRecord')){
            $getRecord ->is_delete = 1;
            $getRecord -> save();
        }
        else{
            abort(404);
        }
        return redirect()->back()->with('success', "Teacher Record Successfully Deleted");
    }
}
