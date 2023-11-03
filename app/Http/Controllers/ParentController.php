<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ParentController extends Controller
{
    public function list(){
        $data['getRecord'] = User::getParent();
        $data['header_title'] = "Parent List";
        return view('admin.parent.list', $data);
    }


    public static function add(){
        $data['getRecord'] = User::getParent();
        $data['header_title'] = "Add New Parent";
        return view('admin.parent.add', $data);
    }

    public function edit($id){

        $data['getRecord'] = User::getSingle($id);

        if(!empty($data['getRecord'])){

            $data['header_title'] = "Edit Parent";
            return view('admin.parent.edit', $data);
        }
        else{
            abort(404);
        }

    }

    public static function insert(Request $request){
        request()->validate([
            'email' => 'required | email|unique:users'
        ]);

        $parent =  new User;
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);
        $parent->occupation = trim($request->occupation);
        $parent->address = trim($request->address);
        $parent->mobile_number = trim($request->mobile_number);


        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;

            $file->move('upload/profile', $filename);

            $parent->profile_pic = $filename;
        }

        $parent->status = trim($request->status);
        $parent->email = trim($request->email);
        $parent->password =  Hash::make($request->password);
        $parent->user_type = 4;
        $parent ->save();

        return redirect('admin/parent/list')->with('success', "Parent Successfully Registered");

    }

    public function update($id, Request $request){
        request()->validate([
            'email' => 'required | email|unique:users,email,'.$id
        ]);

        $parent =  User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->gender = trim($request->gender);
        $parent->occupation = trim($request->occupation);
        $parent->address = trim($request->address);
        $parent->mobile_number = trim($request->mobile_number);


        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;

            $file->move('upload/profile', $filename);

            $parent->profile_pic = $filename;
        }

        $parent->status = trim($request->status);
        $parent->email = trim($request->email);
        $parent->password =  Hash::make($request->password);
        $parent->user_type = 4;
        $parent ->save();

        return redirect('admin/parent/list')->with('success', "Parent Successfully Registered");
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
        return redirect()->back()->with('success', "Parent Record Successfully Deleted");
    }

    public function myStudent($id){
        $data['parent_id'] = $id;

        $data['getSearchStudent'] = User::getSearchStudent();
        $data['getRecord'] = User::getMyStudent($id);
        $data['header_title'] = "Parent Student List";
        return view('admin.parent.my_student', $data);
    }


    public function AssignStudentParent($student_id, $parent_id){
        $student = User::getSingle($student_id);
        $student -> parent_id = $parent_id;
        $student -> save();

        return redirect()->back()->with('success', "Student Successfully Assigned");
    }


    public function AssignStudentParentDelete($student_id){
        $student = User::getSingle($student_id);
        $student -> parent_id = null;
        $student -> save();

        return redirect()->back()->with('success', "Student Successfully Removed From Parent");
    }

    // parent sie

    public function myStudentParent(){
        $id = Auth::user()->id;

        $data['getRecord'] = User::getMyStudent($id);
        $data['header_title'] = "My Child";
        return view('parent.my_student', $data);
    }
}

