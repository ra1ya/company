<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login'); //عرض صفحة تسجيل الدخول
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request /*اسم الكلاس مع الكاين تبعه*/ ): RedirectResponse //تنفيذ تسجيل الدخول وتوجيه المستخدم للداشبورد
    {
        $request->authenticate();
       //تقوم بمحاولة تسجيل الدخول باستخدام الايميل والاباسبورد
       //فنكشن داخل الكلاس قمنا باستدعائه بناء على الكاين
       
       $request->session()->regenerate();
       // يعيد انشائها لمنع الهجمات واجراء امني مهم للوقين
       // Illuminate\Http\Request هي دالة داخل  session()تُرجع الكائن الخاص بالجلسة.
    //يمكنك استخدام جينيريت لاعادة انشاء السنشن

        return redirect()->intended(route('dashboard', absolute: false));
        //يعيد توجيه المستخدم الى الصفحة اللي كان يبغاها قبل اللوقين
       ///route('dashboard'): dashboard.يُرجع الرابط الخاص بمسار اسمه  
      //absolute: false:  لايرجع لك الرابط كامل بل فقط المسار
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse //تسجيل خروج امن وتوجيه المستخدم للصفحة الرئيسة
    {
        Auth::guard('web')->logout();
        //تقوم بتسجيل خروج المستخدم من الجلسة الحالية
        $request->session()->invalidate();
        //تُلغي الجلسة القديمة (تمسح بيانات الـ session).
        $request->session()->regenerateToken();
       //تُعيد إنشاء التوكن الخاص بـ CSRF لحماية الطلبات القادمة.
        return redirect('/');
        //يعيد توجيه المستخدم إلى الصفحة الرئيسية بعد تسجيل الخروج.


    }
}
