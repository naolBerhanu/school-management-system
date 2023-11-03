<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Auth;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassModel;

class ClassController extends Controller
{
    public function list(){
        $data['getRecord'] = ClassModel::getRecord();
        $data['header_title'] = "Class List";
        return view('admin.class.list', $data);
    }

    public function add(){
        $data['header_title'] = "Add New Class";
        return view('admin.class.add', $data);
    }


    public function insert(Request $request){

        $save = new ClassModel;
        $save->name = trim($request->name);
        $save->status = trim($request->status);
        $save->created_by = Auth::user()->id;
        $save -> save();

        return redirect('admin/class/list')->with('success', "Class successfully added.");
    }

    public function edit($id){
        // $data['getRecord'] = ClassModel::getSingle($id);
        // $data['header_title'] = "Edit Class";
        // return view('admin.class.edit', $data);

        $data['getRecord'] = ClassModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Class";
            return view('admin.class.edit', $data);
        }else{
            abort(404);
        }
    }

    public function update($id, Request $request){

        $save = ClassModel::getSingle( $id);

        $save->name = trim($request->name);
        $save->status = trim($request->status);

        $save->save();

        return redirect('admin/class/list')->with('success', "Class successfully Updated.");
    }

    public function delete($id){
        $save = ClassModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('admin/class/list')->with('success', "Class successfully Deleted.");
    }
}
