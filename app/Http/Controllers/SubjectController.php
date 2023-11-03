<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function list(){
        $data['getRecord'] = SubjectModel::getRecord();
        $data['header_title'] = "Subject List";
        return view('admin.subject.list', $data);
    }

    public function add(){
        $data['header_title'] = "Add a new subject";
        return view('admin.subject.add', $data);
    }

    public function insert(Request $request){

        $save = new SubjectModel();
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->created_by = Auth::user()->id;
        $save -> save();

        return redirect('admin/subject/list')->with('success', "Subject successfully added.");
    }

    public function edit($id){
        $data['getRecord'] = SubjectModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Subject";
            return view('admin.subject.edit', $data);
        }else{
            abort(404);
        }
    }

    public function update($id, Request $request){

        $save = SubjectModel::getSingle( $id);

        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);

        $save->save();

        return redirect('admin/subject/list')->with('success', "Subject successfully Updated.");
    }

    public function delete($id){
        $save = SubjectModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('admin/subject/list')->with('success', "Subject successfully Deleted.");
    }

    // student logic
    public function mySubject(){
        $data['getRecord'] = ClassSubjectModel::mySubject(Auth::user()->class_id);
        $data['header_title'] = "My Subjects";
        return view('student.my_subject', $data);
    }

    //parent logic

    public function Parent_Student_Subject($student_id){
        $user = User::getSingle($student_id);
        $data['getUser'] = $user;
        $data['getRecord'] = ClassSubjectModel::mySubject($user->class_id);
        $data['header_title'] = "Student Subjects";
        return view('parent.my_student_subject', $data);
    }
}
