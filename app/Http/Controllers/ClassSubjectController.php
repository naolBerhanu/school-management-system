<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\ClassSubjectModel;
use App\Models\SubjectModel;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;

class ClassSubjectController extends Controller
{
    public function list(Request $request){
        $data['getRecord'] = ClassSubjectModel::getRecord();
        $data['header_title'] = "Assign Subject to Class";
        return view('admin.assign_subject.list', $data);
    }

    public function add(){
        $data['getClass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        $data['header_title'] = "Assign Subject to Class";
        return view('admin.assign_subject.add', $data);
    }

    public function insert(Request $request){

        if(!empty($request->subject_id)){

            foreach($request->subject_id as $subject_id){
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);

                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->is_delete = 0;
                    $getAlreadyFirst -> save();
                 }else{

                    $save = new ClassSubjectModel;
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save ->save();
                }
            }
            return redirect('admin/assign_subject/list')->with('success', "Subject successfully assigned.");
        }else{
            return redirect('admin/assign_subject/list')->with('error', 'Error encountered. Please try again.');
        }
    }


    public function edit($id){
        $getRecord = ClassSubjectModel::getSingle($id);
        if(($getRecord)){
            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectId']= ClassSubjectModel::getAssignSubjectId($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getSubject'] = SubjectModel::getSubject();
            $data['header_title'] = "Edit subject assignment";

            return view('admin.assign_subject.edit', $data);
        }else{
            abort(404);
        }

    }
    public function update(Request $request){

        if(!empty($request->subject_id)){

            foreach($request->subject_id as $subject_id){
                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);

                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst -> save();

                 }else{

                    $save = new ClassSubjectModel;
                    $save->class_id = $request->class_id;
                    $save->subject_id = $subject_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save ->save();
                }


            }
            return redirect('admin/assign_subject/list')->with('success', "Subject successfully Updated.");
        }else{
            return redirect('admin/assign_subject/list')->with('error', 'Error encountered. Please try again.');
        }
    }

    public function delete($id)
    {
        $save = ClassSubjectModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('admin/assign_subject/list')->with('success', "Item successfully Deleted.");
    }

}
