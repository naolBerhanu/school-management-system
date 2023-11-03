<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // User class can be replaced with self as it can also be used here.
    static public function getSingle($id){
        return self::find($id);
    }

    static public function getAdmin(){
        $return = self::select('users.*')
                        ->where('user_type', '=', 1)
                        ->where('is_delete', '=', 0);

                        if(!empty(Request::get('name'))){
                            $return = $return -> where('name', 'like', '%'.Request::get('name').'%');
                        }
                        if(!empty(Request::get('email'))){
                            $return = $return -> where('email', 'like', '%'.Request::get('email').'%');
                        }
        $return = $return ->orderBy('id', 'desc')
                        ->paginate(5);
        return $return;
    }



    static public function getEmailSingle($email ){
        return User::where('email', '=', $email)->first();
    }

    static public function getTokenSingle($remember_token ){
        return User::where('remember_token', '=', $remember_token)->first();
    }

    static public function getSearchStudent(){
        if(!empty(Request::get('name'))){
            $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);

            if(!empty(Request::get('id'))){
                            $return = $return -> where('users.id', '=', Request::get('id'));
                        }
            if(!empty(Request::get('name'))){
                            $return = $return -> where('users.name', 'like', '%'.Request::get('name').'%');
                        }
            if(!empty(Request::get('email'))){
                            $return = $return -> where('users.email', 'like', '%'.Request::get('email').'%');
                        }
            if(!empty(Request::get('admission_number'))){
                            $return = $return -> where('users.admission_number', 'like', '%'.Request::get('admission_number').'%');
                        }


            $return = $return ->orderBy('users.id', 'desc')
                        ->limit(50)
                        ->get();
            return $return;
        }
    }

    static public function getStudent(){
            $return = self::select('users.*', 'class.name as class_name')
                        ->join('class', 'class.id', '=', 'users.class_id', 'left')
                        ->where('users.user_type', '=', 3)
                        ->where('users.is_delete', '=', 0);

           if(!empty(Request::get('name'))){
                            $return = $return -> where('users.name', 'like', '%'.Request::get('name').'%');
                        }
           if(!empty(Request::get('class'))){
                            $return = $return -> where('class.name', 'like', '%'.Request::get('class').'%');
                        }
           if(!empty(Request::get('admission_number'))){
                            $return = $return -> where('users.admission_number', 'like', '%'.Request::get('admission_number').'%');
                        }
           if(!empty(Request::get('gender'))){
                            $return = $return -> where('users.gender', 'like', '%'.Request::get('gender').'%');
                        }
           if(!empty(Request::get('status'))){
                            $status = (Request::get('status') ==  100) ? 0 : 1;
                            $return = $return -> where('users.status', '=', $status);
                        }

            $return = $return ->orderBy('users.id', 'desc')
                        ->paginate(15);
        return $return;
    }

    static public function getParent(){
        $return = self::select('users.*')
        ->where('user_type', '=', 4)
        ->where('is_delete', '=', 0);

        if(!empty(Request::get('name'))){
            $return = $return -> where('name', 'like', '%'.Request::get('name').'%');
        }
        if(!empty(Request::get('email'))){
            $return = $return -> where('email', 'like', '%'.Request::get('email').'%');
        }
        $return = $return ->orderBy('id', 'desc')
                ->paginate(5);
        return $return;
    }

    static public function getTeacher(){
        $return = self::select('users.*')
                ->where('user_type', '=', 2)
                ->where('is_delete', '=', 0);

        if(!empty(Request::get('name'))){
            $return = $return -> where('name', 'like', '%'.Request::get('name').'%');
        }
        if(!empty(Request::get('email'))){
            $return = $return -> where('email', 'like', '%'.Request::get('email').'%');
        }
        $return = $return ->orderBy('id', 'desc')
                ->paginate(5);

        return $return;
    }

    public function getProfile(){
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic)){
            return url('upload/profile/'.$this->profile_pic);

        }else{
            return "";
        }
    }

    public function getProfileDirect(){
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic)){
            return url('upload/profile/'.$this->profile_pic);

        }else{
            return url('upload/profile/user.jpg');
        }
    }

    static function getMyStudent($parent_id){
        $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'parent.mobile_number as mobile_number')
                ->join('class', 'class.id', '=', 'users.class_id', 'left')
                ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left' )
                ->where('users.user_type', '=', 3)
                ->where('users.parent_id', '=', $parent_id)
                ->where('users.is_delete', '=', 0)
                ->orderBy('users.id', 'desc')
                ->get();

        return $return;
    }


    static public function getSubjectClass($class_id){
        $return = self::select('users.id', 'users.name', 'users.last_name')
                    ->where('users.user_type', '=', 3)
                    ->where('users.is_delete', '=', 0)
                    ->where('users.class_id', '=', $class_id);
        $return = $return ->orderBy('users.id', 'desc')
                    ->get();
    return $return;
    }

    static public function getTotalUser($user_type){
            return  self::select('users.id')
                ->where('user_type', '=', $user_type)
                ->where('is_delete', '=', 0)
                ->count();
    }
}
