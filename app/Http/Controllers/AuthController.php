<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Mail\ForgotPassWordMail;
use Mail;
use Str;

class AuthController extends Controller
{
    public function login()
    {
        // dd(Hash::make(123456789));
        // return view('auth.login');
        /* 
         * đăng nhập đúng với usertype trong databse 
         * được dẫn đến dashboard tương ứng 
         * ngược lại sẽ quay lại giao diện đăng nhập
         */
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } else if (Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard');
            } else if (Auth::user()->user_type == 3) {
                return redirect('student/dashboard');
            } else if (Auth::user()->user_type == 4) {
                return redirect('parent/dashboard');
            }
        }
        return view('auth.login');
    }
    public function AuthLogin(Request $request)
    {
        /* 
         * lấy dữ liệu từ request để kiểm tra thông tin đăng nhập của người dùng. 
         * Nó kiểm tra xem người dùng đã chọn tuỳ chọn "ghi nhớ đăng nhập" hay không
         * 
         * Auth::attempt() để thử xác thực người dùng với email và mật khẩu được cung cấp. 
         * Nếu xác thực thành công, người dùng sẽ được đăng nhập vào hệ thống
         * 
         * Nếu xác thực thành công, sẽ kiểm tra kiểu người dùng 
         * và điều hướng họ đến trang điều khiển tương ứng dựa trên kiểu người dùng đó
         */
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            if (Auth::user()->user_type == 1) {
                return redirect('admin/dashboard');
            } else if (Auth::user()->user_type == 2) {
                return redirect('teacher/dashboard');
            } else if (Auth::user()->user_type == 3) {
                return redirect('student/dashboard');
            } else if (Auth::user()->user_type == 4) {
                return redirect('parent/dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Please enter current email and password');
        }
    }
    public function logout()
    {
        /* 
         * xóa thông tin xác thực của người dùng và đưa họ trở về trạng thái chưa đăng nhập
         * 
         * Sau khi đăng xuất thành công, người dùng sẽ được điều hướng về trang chủ của hệ thống
         */
        Auth::logout();
        return redirect(url(''));
    }
    public function forgotpassword()
    {
        /* 
         * điều hướng đến trang quên mật khẩu
         */
        return view('auth.forgot');
    }
    public function PostForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPassWordMail($user));
            return redirect()->back()->with('success', 'please check email and reset your password');
        } else {
            return redirect()->back()->with('error', 'Email not found in the system');
        }
    }
    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if (!empty($user)) {
            $data['user'] = $user;
            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }
    public function Postreset($token, Request $request)
    {
        if ($request->password == $request->cpassword) {
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect(url(''))->with('success', 'Password Successfull');
        } else {
            return redirect()->back()->with('error', 'password and password confirm does not match');
        }
    }
}
