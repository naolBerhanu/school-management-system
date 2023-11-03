<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Request;

class ExamModel extends Model
{
    use HasFactory;

    protected $table = 'exam';

    static public function getRecord(){
        return self::select('exam.*', 'users.name as created_by')
                    ->join('users', 'users.id', '=', 'exam.created_by')
                    ->where('exam.is_delete', '=', '0')
                    ->orderBy('exam.id', 'desc')
                    ->paginate(50);
    }

    static public function getSingle($id){
        return self::find($id);
    }

    static public function getExam(){
        return self::select('exam.*')
        ->join('users', 'users.id', '=', 'exam.created_by')
        ->where('exam.is_delete', '=', '0')
        ->orderBy('exam.name', 'asc')
        ->get();
    }


}
