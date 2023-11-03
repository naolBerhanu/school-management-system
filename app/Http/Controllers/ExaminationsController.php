<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ExamScheduleModel;
use Illuminate\Http\Request;
use App\Models\ExamModel;
use App\Models\SubjectModel;
use App\Models\MarksRegisterModel;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class ExaminationsController extends Controller
{
    public function exam_list(){
        $data['getRecord'] = ExamModel::getRecord();
        $data['header_title'] = "Exam List";
        return view('admin.examinations.exam.list', $data);
    }

    public function exam_add(){
        $data['header_title'] = "Add New Exam";
        return view('admin.examinations.exam.add', $data);
    }

    public function exam_insert(Request $request){
        $exam = new ExamModel();

        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->created_by = Auth::user()->id;
        $exam -> save();

        return redirect('admin/examinations/exam/list')->with('success', "Exam successfully created.");
    }

    public function exam_delete($id){
        $save = ExamModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('admin/examinations/exam/list')->with('success', "Exam successfully deleted.");
    }

    public function exam_edit($id){
        $data['getRecord'] = ExamModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Exam";
            return view('admin/examinations/exam/edit', $data);
        }else{
            abort(404);
        }
    }

    public function exam_update($id, Request $request){

        $save = ExamModel::getSingle( $id);

        $save->name = trim($request->name);
        $save->note = trim($request->note);

        $save->save();

        return redirect('admin/examinations/exam/list')->with('success', "Exam successfully Updated.");
    }

    public function exam_schedule(Request $request){
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();
        $data['header_title'] = "Exam Schedule";

        $result = array();

         if(!empty($request->get('exam_id')) && !empty($request->get('class_id')) )
         {
             $getSubject = ClassSubjectModel::mySubject($request->get('class_id'));
             foreach($getSubject as $value){
                $dataS = array();

                // $dataS['exam_id'] = $value->id;

                $dataS['subject_id'] = $value->subject_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['class_name'] = $value->class_name;
                $dataS['subject_name'] = $value->subject_name;
                $dataS['subject_type'] = $value->subject_type;
                $dataS['room_number'] = $value->room_number;
                $dataS['exam_date'] = $value->exam_date;

                $ExamSchedule = ExamScheduleModel::getRecordSingle($request->get('exam_id'), $request->get('class_id'), $value->subject_id);

                if(!empty($ExamSchedule)){
                    $dataS['exam_date'] = $ExamSchedule->exam_date;
                    $dataS['room_number'] = $ExamSchedule->room_number;
                    $dataS['end_time'] = $ExamSchedule->end_time;
                    $dataS['start_time'] = $ExamSchedule->start_time;
                    $dataS['full_marks'] = $ExamSchedule->full_marks;
                    $dataS['passing_mark'] = $ExamSchedule->passing_mark;
                }else{
                    $dataS['exam_date'] = '';
                    $dataS['room_number'] = '';
                    $dataS['end_time'] = '';
                    $dataS['start_time'] = '';
                    $dataS['full_marks'] = '';
                    $dataS['passing_mark'] = '';
                }

                $result[] = $dataS; //pushing into array
            }

        }
        // dd($result );
            $data['getRecord'] = $result;
        return view('admin/examinations/exam_schedule', $data);
    }

    public function exam_schedule_insert(Request $request){

        // deletes a schedule and makes  it empty so that it can be replaced
       ExamScheduleModel::deleteRecord($request->exam_id, $request->class_id);

       if(!empty($request->schedule)){

        foreach($request->schedule as $schedule){

            if(!empty($schedule['room_number']) && !empty($schedule['exam_date']) && !empty($schedule['start_time'])){

                // dd($request->all());
                $current_date = date('Y-m-d');
                if ($schedule['exam_date'] >= $current_date){
                    $start_time = date('H:00:00', strtotime($schedule['start_time']));
                    $start_time = max('08:00:00', $start_time);

                    $end_time = date('H:00:00', strtotime($start_time. '+2 hours'));

                    // $end_time = max('17:00', $end_time);

                    $exam = new ExamScheduleModel;

                    $exam->exam_id = $request->exam_id;
                    $exam->class_id = $request->class_id;

                    $exam->subject_id = $schedule['subject_id'];
                    $exam->exam_date = $schedule['exam_date'];

                    // $exam->start_time = $schedule['start_time'];
                    // $exam->end_time = $schedule['end_time'];

                    $exam->start_time = $start_time;
                    $exam->end_time = $end_time;

                    $exam->room_number = $schedule['room_number'];
                    $exam->full_marks = $schedule['full_marks'];
                    $exam->passing_mark = $schedule['passing_mark'];
                    $exam->created_by = Auth::user()->id;

                    $exam->save();
                }else{
                    return redirect()->back()->with('error', 'Invalid Exam Date. The exam date must be from current date onward.');
                }

            }
            }
        }
        return redirect()->back()->with('success', 'Exam Scheduled Successfully.');

    }


    public function marks_register(Request $request){
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();
        $data['header_title'] = "Mark Register";

        if(!empty($request->get('exam_id')) || !empty($request->get('class_id'))){
            $data['getSubject']  = ExamScheduleModel::getSubject($request->get('exam_id'), $request->get('class_id'));
            $data['getStudent']  = User::getSubjectClass($request->get('class_id'));

            // dd($data['getStudent']);
        }
        return view('admin.examinations.marks_register', $data);
    }


    public function submit_marks_register(Request $request){
        if(!empty($request->mark)){
            foreach($request->mark as $mark){
                $test = !empty($mark['test']) ? $mark['test'] : 0;
                $mid = !empty($mark['mid']) ? $mark['mid'] : 0;
                $final = !empty($mark['final']) ? $mark['final'] : 0;

                $full_marks = !empty($mark['full_marks']) ? $mark['full_marks'] : 0;
                $passing_mark = !empty($mark['passing_mark']) ? $mark['passing_mark'] : 0;

                $getMark = MarksRegisterModel::CheckAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $mark['subject_id']);
                if(!empty($getMark)){
                    $save = $getMark;
                }else{
                    $save =  new MarksRegisterModel;
                    $save->created_by =  Auth::user()->id;
                }
                $save->student_id = $request->student_id;
                $save->exam_id = $request->exam_id;
                $save->class_id = $request->class_id;
                $save->subject_id = $mark['subject_id'];
                $save->test = $test;
                $save->mid = $mid;
                $save->final = $final;
                $save->full_marks = $full_marks;
                $save->passing_mark = $passing_mark;


                $save->save();
            }
        }

        $json['message'] = "Mark Recorded Successfully";
        echo json_encode($json);
        // dd($request->all());
    }

    // on student side
    public function myExamResult(){
        $data['header_title'] = "My Exam Result";

        $result = array();
        $getExam = MarksRegisterModel::getExam(Auth::user()->id);
        foreach($getExam as $value){
            $dataE = array();
            $dataE['exam_name'] = $value->exam_name;
            $dataE['exam_id'] = $value->exam_id;

            $getExamSubject = MarksRegisterModel::getExamSubject($value->exam_id, Auth::user()->id);
            $dataSubject = array();

            foreach($getExamSubject as $examResult){
                $dataS = array();
                $dataS['subject_name'] = $examResult['subject_name'];
                $dataS['test'] = $examResult['test'];
                $dataS['mid'] = $examResult['mid'];
                $dataS['final'] = $examResult['final'];
                $dataS['subject_name'] = $examResult['subject_name'];
                $dataS['full_marks'] = $examResult['full_marks'];
                $dataS['passing_mark'] = $examResult['passing_mark'];

                $dataSubject[]= $dataS;

            }

            $dataE['subject'] = $dataSubject;

            $result[] = $dataE;
            // dd($getExamSubject);

        }

        // dd($result);
        $data['getRecord'] = $result;

        return view('student/my_exam_result', $data);
    }

    public function myExamResultPrint(Request $request){

        $exam_id = $request->exam_id;
        $student_id = $request->student_id;

        $data['getExam'] = ExamModel::getSingle($exam_id);
        $data['getStudent'] = User::getSingle($student_id);
        $data['getClass'] = MarksRegisterModel::getClass($exam_id, $student_id);

        $getExamSubject = MarksRegisterModel::getExamSubject($exam_id, $student_id);

        $dataSubject = array();

        foreach($getExamSubject as $examResult){
            $dataS = array();
            $dataS['subject_name'] = $examResult['subject_name'];
            $dataS['test'] = $examResult['test'];
            $dataS['mid'] = $examResult['mid'];
            $dataS['final'] = $examResult['final'];
            $dataS['subject_name'] = $examResult['subject_name'];
            $dataS['full_marks'] = $examResult['full_marks'];
            $dataS['passing_mark'] = $examResult['passing_mark'];

            $dataSubject[]= $dataS;

        }

        $data['getExamMark'] = $dataSubject;
        return view('exam_result_print', $data);
    }

    // parent side show exam result
    public function Parent_Student_Exam_Result($student_id){
        $data['header_title'] = "My Exam Result";
        $user = User::getSingle($student_id);
        $data['getUser'] = $user;

        $result = array();
        $getExam = MarksRegisterModel::getExam($student_id);
        foreach($getExam as $value){
            $dataE = array();
            $dataE['exam_name'] = $value->exam_name;
            $dataE['exam_id'] = $value->exam_id;

            $getExamSubject = MarksRegisterModel::getExamSubject($value->exam_id, $student_id);
            $dataSubject = array();

            foreach($getExamSubject as $examResult){
                $dataS = array();
                $dataS['subject_name'] = $examResult['subject_name'];
                $dataS['test'] = $examResult['test'];
                $dataS['mid'] = $examResult['mid'];
                $dataS['final'] = $examResult['final'];
                $dataS['subject_name'] = $examResult['subject_name'];
                $dataS['full_marks'] = $examResult['full_marks'];
                $dataS['passing_mark'] = $examResult['passing_mark'];

                $dataSubject[]= $dataS;

            }

            $dataE['subject'] = $dataSubject;

            $result[] = $dataE;
            // dd($getExamSubject);

        }

        // dd($result);
        $data['getRecord'] = $result;

        return view('parent/exam_result', $data);
    }
}
