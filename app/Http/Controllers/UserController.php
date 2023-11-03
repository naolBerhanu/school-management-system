<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function MyAccount(){
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Account";

       if(Auth::user()->user_type == 1){
        return view('admin.admin.my_account', $data);
       }
       elseif(Auth::user()->user_type == 2){
        return view('teacher.my_account', $data);
       }
       elseif(Auth::user()->user_type == 3){
        return view('student.my_account', $data);
       }
       elseif(Auth::user()->user_type == 4){
        return view('parent.my_account', $data);
       }
    }
    public function UpdateMyAccountAdmin(Request $request){
        $id = Auth::user()->id;


        request()->validate([
            'email' => 'required | email|unique:users,email,'.$id
        ]);

          $admin =  User::getSingle($id);
          $admin->name = trim($request->name);
          $admin->last_name = trim($request->last_name);
          $admin->email = trim($request->email);


          if(!empty($request->file('profile_pic'))){
              $ext = $request->file('profile_pic')->getClientOriginalExtension();
              $file = $request->file('profile_pic');
              $randomStr = Str::random(20);
              $filename = strtolower($randomStr).'.'.$ext;

              $file->move('upload/profile', $filename);

              $admin->profile_pic = $filename;
          }

          $admin ->save();

          return redirect()->back()->with('success', "Record Successfully Updated.");
}


    public function UpdateMyAccountTeacher(Request $request){
            $id = Auth::user()->id;


            request()->validate([
                'email' => 'required | email|unique:users,email,'.$id
            ]);
              $teacher =  User::getSingle($id);
              $teacher->name = trim($request->name);
              $teacher->last_name = trim($request->last_name);
              $teacher->email = trim($request->email);
              $teacher->qualification = trim($request->qualification);
              $teacher->experience = trim($request->experience);
              $teacher->address = trim($request->address);
              $teacher->mobile_number = trim($request->mobile_number);


              if(!empty($request->file('profile_pic'))){
                  $ext = $request->file('profile_pic')->getClientOriginalExtension();
                  $file = $request->file('profile_pic');
                  $randomStr = Str::random(20);
                  $filename = strtolower($randomStr).'.'.$ext;

                  $file->move('upload/profile', $filename);

                  $teacher->profile_pic = $filename;
              }
              $teacher->user_type = 2;
              $teacher ->save();

              return redirect()->back()->with('success', "Record Successfully Updated.");
    }

    public function UpdateMyAccountStudent(Request $request){
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required | email|unique:users,email,'.$id
        ]);

        $student =  User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->nationality = trim($request->nationality);
        $student->mobile_number = trim($request->mobile_number);

        $student->email = trim($request->email);

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;

            $file->move('upload/profile', $filename);

            $student->profile_pic = $filename;
        }

        $student ->save();

        return redirect()->back()->with('success', "Student Record Successfully Updated");

    }
    public function UpdateMyAccountParent(Request $request){
        $id = Auth::user()->id;
        request()->validate([
            'email' => 'required | email|unique:users,email,'.$id
        ]);

        $parent =  User::getSingle($id);
        $parent->name = trim($request->name);
        $parent->last_name = trim($request->last_name);
        $parent->occupation = trim($request->occupation);
        $parent->mobile_number = trim($request->mobile_number);
        $parent->address = trim($request->address);

        $parent->email = trim($request->email);

        if(!empty($request->file('profile_pic'))){
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;

            $file->move('upload/profile', $filename);

            $parent->profile_pic = $filename;
        }

        $parent ->save();

        return redirect()->back()->with('success', "Record Successfully Updated");
    }

    public function change_password(){
        $data['header_title'] = "Change your password";
        return view('profile.change_password', $data);
    }

    public function update_change_password(Request $request){
        $user = User::getSingle(Auth::user()->id);
        if(Hash::check($request->old_password, $user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user -> save();

            return redirect()->back()->with('success', "Password successfully updated.");
        }
        else{
            return redirect()->back()->with('error', "Incorrect Password, Try Again!");
        }
    }


}

