<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function list(){
        $data['getRecord'] = User::getStudent();
        $data['header_title'] = "Student List";
        return view('admin.student.list', $data);
    }

    public static function add(){
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add New Student";
        return view('admin.student.add', $data);
    }

    public static function insert(Request $request){
        request()->validate([
            'email' => 'required | email|unique:users'
        ]);

        $student =  new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        $student->date_of_birth = trim($request->date_of_birth);
        $student->nationality = trim($request->nationality);
        $student->mobile_number = trim($request->mobile_number);
        $student->admission_date = trim($request->admission_date);


        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;

            $file->move('upload/profile', $filename);

            $student->profile_pic = $filename;
        }

        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password =  Hash::make($request->password);
        $student->user_type = 3;
        $student ->save();

        return redirect('admin/student/list')->with('success', "Student Successfully Registered");

    }


    public function edit($id){

        $data['getRecord'] = User::getSingle($id);

        if(!empty($data['getRecord'])){
            $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = "Edit Student";
            return view('admin.student.edit', $data);
        }
        else{
            abort(404);
        }

    }

    public function update($id, Request $request){
        request()->validate([
            'email' => 'required | email|unique:users,email,'.$id
        ]);

        $student =  User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->gender = trim($request->gender);
        $student->date_of_birth = trim($request->date_of_birth);
        $student->nationality = trim($request->nationality);
        $student->mobile_number = trim($request->mobile_number);
        $student->admission_date = trim($request->admission_date);

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;

            $file->move('upload/profile', $filename);

            $student->profile_pic = $filename;
        }

        $student->status = trim($request->status);
        $student->email = trim($request->email);
        if(!empty($request->password)){
            $student->password =  Hash::make($request->password);
        }

        $student ->save();

        return redirect('admin/student/list')->with('success', "Student Record Successfully Updated");
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
        return redirect()->back()->with('success', "Student Record Successfully Deleted");
    }
}
