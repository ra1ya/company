<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Students;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

   public function login(){
    return view('auth.login');
   }
   
   function loginPost(Request $request){
    
    $request->validate([
        "name" => "required",
        "password" => "required|min:6",
        
    ]);
    try {
        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route("home"));
        }
        
        return redirect(route("login"))->with("error", "Login failed. Invalid email or password.");
    } catch (\Exception $e) {
        return redirect(route("login"))->with("error", "Error: " . $e->getMessage());
    }
    
    
   }

   function register(){
    return view('auth.register');
   }

   function registerPost(Request $request)
{
    $request->validate([
        "name" => "required",
        "email" => "required",
        "password" => "required|min:6",
        "mobile" => "required|digits:10",
        "address" => "required",
    ]);

    try {
        $student = new Students();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->mobile = $request->mobile;
        $student->address = $request->address;

        if ($student->save()) {
            return redirect(route("login"))->with("success", "Account created successfully.");
        } else {
            return redirect(route("register"))->with("error", "Failed to create account.");
        }
    } catch (\Exception $e) {
        return redirect(route("register"))->with("error", "Error: " . $e->getMessage());
    }
}











    /*
      // الطريقة لعرض نموذج تسجيل الدخول
      public function showLoginForm()
      {
          return view('auth.login');  // تأكد من أن القالب (view) موجود في resources/views/auth/login.blade.php
      }
   

      public function register(Request $request)
      {
          $request->validate([
              'name' => 'required',
              'email' => 'required|email|unique:students,email',
              'password' => 'required|min:6',
              'mobile' => 'nullable|string', // تحقق من إضافة الحقل
          ]);
      
          Students::create([
              'name' => $request->name,
              'email' => $request->email,
              'password' => bcrypt($request->password),
              'mobile' => $request->mobile, // إضافة الموبايل
          ]);
      
          return redirect()->back()->with('success', 'تم التسجيل بنجاح!');
      }
      

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',  // التحقق من أن البريد الإلكتروني موجود وصحيح
            'password' => 'required',     // التحقق من أن كلمة المرور موجودة
        ]);
   // ثانيًا: البحث عن المستخدم في قاعدة البيانات باستخدام البريد الإلكتروني
   $user = Students::where('email', $request->email)->first();

   // ثالثًا: التحقق مما إذا كان المستخدم موجودًا وإذا كانت كلمة المرور صحيحة
   if (!$user || !Hash::check($request->password, $user->password)) {
       // إذا لم يتم العثور على المستخدم أو كانت كلمة المرور غير صحيحة
       // العودة إلى الصفحة السابقة مع رسالة خطأ
       return redirect()->back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
   }

        Auth::login($user);
        return redirect()->route('layout'); 
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
    public function showRegistrationForm()
{
    return view('auth.register');
}
*/
}
