<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

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
    ];
    static public function getEmailSingle($email)
    {
        /*
         * tìm kiếm một bản ghi trong cơ sở dữ liệu dựa trên địa chỉ email được cung cấp
         * và trả về bản ghi đầu tiên mà nó tìm thấy.
         */
        return User::where('email', '=', $email)->first();
    }
    static public function getTokenSingle($remember_token)
    {

        return User::where('remember_token', '=', $remember_token)->first();
    }
    static public function getAdmin()
    {
        $return = self::select('users.*')
            ->where('user_type', '=', 1)
            ->where('is_delete', '=', 0);
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('created_at', '=', Request::get('date'));
        }
        $return = $return->orderBy('id', 'asc')
            ->paginate(5);
        return $return;
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    static public function getStudent()
    {
        $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name', 'parent.last_name as parent_last_name')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('admission_number'))) {
            $return = $return->where('users.admission_number', 'like', '%' . Request::get('admission_number') . '%');
        }
        if (!empty(Request::get('roll_number'))) {
            $return = $return->where('users.roll_number', 'like', '%' . Request::get('roll_number') . '%');
        }
        if (!empty(Request::get('class_name'))) {
            $return = $return->where('users.class_name', 'like', '%' . Request::get('class_name') . '%');
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', 'like', '%' . Request::get('gender') . '%');
        }
        if (!empty(Request::get('date_of_birth'))) {
            $return = $return->where('users.date_of_birth', 'like', '%' . Request::get('date_of_birth') . '%');
        }
        if (!empty(Request::get('caste'))) {
            $return = $return->where('users.caste', 'like', '%' . Request::get('caste') . '%');
        }
        if (!empty(Request::get('religion'))) {
            $return = $return->where('users.religion', 'like', '%' . Request::get('religion') . '%');
        }
        if (!empty(Request::get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('admission_date'))) {
            $return = $return->whereDate('users.admission_date', '=', Request::get('admission_date'));
        }
        if (!empty(Request::get('blood_group'))) {
            $return = $return->where('users.blood_group', 'like', '%' . Request::get('blood_group') . '%');
        }
        if (!empty(Request::get('height'))) {
            $return = $return->where('users.height', '=', Request::get('height'));
        }
        if (!empty(Request::get('weight'))) {
            $return = $return->where('users.weight', '=', Request::get('weight'));
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $return = $return->whereDate('users.status', '=', $status);
        }
        $return = $return->orderBy('users.id', 'asc')
            ->paginate(5);
        return $return;
    }
    public function getProfile()
    {
        if (!empty($this->profile_pic) && file_exists('upload/profile/' . $this->profile_pic)) {
            return url('upload/profile/' . $this->profile_pic);
        } else {
            return "";
        }
    }
    static public function getParent()
    {
        $return = self::select('users.*')
            ->where('user_type', '=', 4)
            ->where('is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('address'))) {
            $return = $return->where('users.address', 'like', '%' . Request::get('address') . '%');
        }
        if (!empty(Request::get('occupation'))) {
            $return = $return->where('users.occupation', 'like', '%' . Request::get('occupation') . '%');
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', 'like', '%' . Request::get('gender') . '%');
        }
        if (!empty(Request::get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $return = $return->whereDate('users.status', '=', $status);
        }
        $return = $return->orderBy('id', 'asc')
            ->paginate(5);
        return $return;
    }
    static public function getSearchStudent()
    {
        if (
            !empty(Request::get('id')) || !empty(Request::get('name')) ||
            !empty(Request::get('last_name')) || !empty(Request::get('email'))
        ) {
            $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name')
                ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
                ->join('class', 'class.id', '=', 'users.class_id', 'left')
                ->where('users.user_type', '=', 3)
                ->where('users.is_delete', '=', 0);
            if (!empty(Request::get('id'))) {
                $return = $return->where('users.id', '=', Request::get('id'));
            }
            if (!empty(Request::get('name'))) {
                $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
            }
            if (!empty(Request::get('last_name'))) {
                $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
            }
            if (!empty(Request::get('email'))) {
                $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
            }
            $return = $return->orderBy('users.id', 'asc')
                ->limit(10)
                ->get();
            return $return;
        }

    }
    static public function getMyStudent($parent_id)
    {
        $return = self::select('users.*', 'class.name as class_name', 'parent.name as parent_name')
            ->join('users as parent', 'parent.id', '=', 'users.parent_id')
            ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', '=', 3)
            ->where('users.parent_id', '=', $parent_id)
            ->where('users.is_delete', '=', 0)
            ->orderBy('users.id', 'asc')
            ->limit(10)
            ->get();
        return $return;
    }
    // 
    static public function getStudentClass($class_id)
    {
        $return = self::select('users.*', 'users.name', 'users.last_name')
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0)
            ->where('users.class_id', '=',$class_id)
            ->orderBy('users.id', 'asc')
            ->get();
        return $return;
    }
    static public function getTeacher()
    {
        $return = self::select('users.*')
            // ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
            // ->join('class', 'class.id', '=', 'users.class_id', 'left')
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0);
        if (!empty(Request::get('name'))) {
            $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('users.gender', 'like', '%' . Request::get('gender') . '%');
        }
        if (!empty(Request::get('date_of_birth'))) {
            $return = $return->where('users.date_of_birth', 'like', '%' . Request::get('date_of_birth') . '%');
        }
        if (!empty(Request::get('date_of_joining'))) {
            $return = $return->where('users.date_of_joining', 'like', '%' . Request::get('date_of_joining') . '%');
        }
        if (!empty(Request::get('mobile_number'))) {
            $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
        }
        if (!empty(Request::get('marital_status'))) {
            $return = $return->where('users.marital_status', 'like', '%' . Request::get('marital_status') . '%');
        }
        if (!empty(Request::get('address'))) {
            $return = $return->where('users.address', 'like', '%' . Request::get('address') . '%');
        }
        if (!empty(Request::get('status'))) {
            $status = (Request::get('status') == 100) ? 0 : 1;
            $return = $return->whereDate('users.status', '=', $status);
        }
        $return = $return->orderBy('users.id', 'asc')
            ->paginate(5);
        return $return;
    }
    static public function getTeacherClass()
    {
        $return = self::select('users.*')
            ->where('users.user_type', '=', 2)
            ->where('users.is_delete', '=', 0);
        $return = $return->orderBy('users.id', 'asc')
            ->get();
        return $return;
    }
    static public function getTeacherStudent($teacher_id)
    {
        $return = self::select('users.*', 'class.name as class_name')
            // ->join('users as parent', 'parent.id', '=', 'users.parent_id', 'left')
            ->join('class', 'class.id', '=', 'users.class_id')
            ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class.id')
            ->where('assign_class_teacher.teacher_id', '=', $teacher_id)
            ->where('assign_class_teacher.status', '=', 0)
            ->where('users.user_type', '=', 3)
            ->where('users.is_delete', '=', 0);
        // if (!empty(Request::get('name'))) {
        //     $return = $return->where('users.name', 'like', '%' . Request::get('name') . '%');
        // }
        // if (!empty(Request::get('last_name'))) {
        //     $return = $return->where('users.last_name', 'like', '%' . Request::get('last_name') . '%');
        // }
        // if (!empty(Request::get('email'))) {
        //     $return = $return->where('users.email', 'like', '%' . Request::get('email') . '%');
        // }
        // if (!empty(Request::get('admission_number'))) {
        //     $return = $return->where('users.admission_number', 'like', '%' . Request::get('admission_number') . '%');
        // }
        // if (!empty(Request::get('roll_number'))) {
        //     $return = $return->where('users.roll_number', 'like', '%' . Request::get('roll_number') . '%');
        // }
        // if (!empty(Request::get('class_name'))) {
        //     $return = $return->where('users.class_name', 'like', '%' . Request::get('class_name') . '%');
        // }
        // if (!empty(Request::get('gender'))) {
        //     $return = $return->where('users.gender', 'like', '%' . Request::get('gender') . '%');
        // }
        // if (!empty(Request::get('date_of_birth'))) {
        //     $return = $return->where('users.date_of_birth', 'like', '%' . Request::get('date_of_birth') . '%');
        // }
        // if (!empty(Request::get('caste'))) {
        //     $return = $return->where('users.caste', 'like', '%' . Request::get('caste') . '%');
        // }
        // if (!empty(Request::get('religion'))) {
        //     $return = $return->where('users.religion', 'like', '%' . Request::get('religion') . '%');
        // }
        // if (!empty(Request::get('mobile_number'))) {
        //     $return = $return->where('users.mobile_number', 'like', '%' . Request::get('mobile_number') . '%');
        // }
        // if (!empty(Request::get('admission_date'))) {
        //     $return = $return->whereDate('users.admission_date', '=', Request::get('admission_date'));
        // }
        // if (!empty(Request::get('blood_group'))) {
        //     $return = $return->where('users.blood_group', 'like', '%' . Request::get('blood_group') . '%');
        // }
        // if (!empty(Request::get('height'))) {
        //     $return = $return->where('users.height', '=', Request::get('height'));
        // }
        // if (!empty(Request::get('weight'))) {
        //     $return = $return->where('users.weight', '=', Request::get('weight'));
        // }
        // if (!empty(Request::get('status'))) {
        //     $status = (Request::get('status') == 100) ? 0 : 1;
        //     $return = $return->whereDate('users.status', '=', $status);
        // }
        $return = $return->orderBy('users.id', 'asc')
            ->groupBy('users.id')
            ->paginate(5);
        return $return;
    }
}
