<?php

namespace App\Http\Controllers;

use App\Models\ClassSubjectModel;
use Illuminate\Http\Request;

use App\Models\ClassModel;
use App\Models\User;
use App\Models\AssignClassTeacherModel;
use Illuminate\Support\Facades\Auth;

class AssignClassTeacherController extends Controller
{
    public function list(Request $request){

        $data['getRecord'] = AssignClassTeacherModel::getRecord();

        $data['header_title'] = "Assign subject to teacher";
        return view('.admin.assign_class_teacher.list', $data);
    }

    public function add(Request $request){
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacher();
        $data['header_title'] = "Assign Class to Teacher";
        return view('admin.assign_class_teacher.add', $data);
    }

    public function insert(Request $request){

        if(!empty($request->teacher_id)){

            foreach($request->teacher_id as $teacher_id){
                $getAlreadyFirst = AssignClassTeacherModel::getAlreadyFirst($request->class_id, $teacher_id);

                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->is_delete = 0;
                    $getAlreadyFirst -> save();
                 }else{

                    $save = new AssignClassTeacherModel();
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save ->save();
                }
            }
            return redirect('admin/assign_class_teacher/list')->with('success', "Class successfully assigned to teacher.");
        }else{
            return redirect('admin/assign_class_teacher/list')->with('error', 'Error encountered. Please try again.');
        }
    }


}
