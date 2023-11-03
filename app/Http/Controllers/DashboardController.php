<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard(){
        $data['header_title'] = 'Dashboard';
        if(!empty(Auth::check())){
            if(Auth::user()->user_type ==1 ){
              $data['TotalAdmin'] = User::getTotalUser(1);
              $data['TotalTeacher'] = User::getTotalUser(2);
              $data['TotalStudent'] = User::getTotalUser(3);
              $data['TotalParent'] = User::getTotalUser(4);
              return view('admin/dashboard', $data);
            }
            else if(Auth::user()->user_type ==2 ){
                return view('teacher/dashboard', $data);
            }
            else if(Auth::user()->user_type ==3 ){
                return view('student/dashboard', $data);
            }
            else if(Auth::user()->user_type ==4 ){
                return view('parent/dashboard', $data);
            }
          }
    }
}
