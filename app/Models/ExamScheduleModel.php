<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScheduleModel extends Model
{
    use HasFactory;

    protected $table = 'exam_schedule';

    static public function getRecordSingle($exam_id, $class_id,  $subject_id){
        return self::where('exam_id', '=', $exam_id)
                                ->where('class_id', '=',  $class_id)
                                ->where('subject_id', '=', $subject_id)
                                ->first();
    }

        // deletes a schedule and makes  it empty so that it can be replaced
    static public function deleteRecord($exam_id, $class_id){
         self::where('exam_id', '=', $exam_id)
            ->where('class_id', '=',  $class_id)
            ->delete();
    }

    static public function getSubject($exam_id,  $class_id)
    {
        return self::select('exam_schedule.*', 'subject.name as subject_name', 'subject.type as subject_type')
                    ->join('subject', 'subject.id', '=', 'exam_schedule.subject_id')
                    ->where('exam_schedule.exam_id', '=', $exam_id)
                    ->where('exam_schedule.class_id', '=', $class_id)
                    ->get();
    }

    static public function getMark($student_id, $exam_id, $class_id, $subject_id){
        return MarksRegisterModel::CheckAlreadyMark($student_id, $exam_id, $class_id, $subject_id);

    }
}
