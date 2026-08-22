<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool  //يسمح للجميع بمحاولة الدخول
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array  //يتحقق من أن البريد وكلمة المرور موجودان وبصيغة صحيحة
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void //	ينفذ المحاولة الفعلية لتسجيل الدخول ويطبق التحقق من معدل المحاولات
    {
        $this->ensureIsNotRateLimited();
        //نستدعي الدالة هاذي للتاكد ان المتسخدم لم يحاول  تسجيل الدخول كثيرا خلال وقت قصير

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            //Auth::attempt() تحاول تسجيل دخول باستخدام البريد الالكتروني و كلمة المرور
            //$this->only('email', 'password') ← تأخذ فقط هذين الحقلين من الطلب.
            //$this->boolean('remember') ← تأخذ قيمة "تذكرني" كقيمة منطقية true/false.
           
            RateLimiter::hit($this->throttleKey());
            //زيادة عداد المحاولات لهذا المستخدم/العنوان
            //throttleKey() ← هو المفتاح الذي يتم استخدامه لتحديد من قام بالمحاولة.

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
         //اذا كانت البيانات الخاطئة 
//ترمي استثناء يحتوي على رسالة "فشل تسجيل الدخول".
//تُرسل الرسالة للواجهة (Form) لتظهر أسفل حقل البريد الإلكتروني

        RateLimiter::clear($this->throttleKey());
        //يتم تصفير عداد المحاولات لأنه تم الدخول بنجاح
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void //يمنع محاولات تسجيل الدخول المتكررة بشكل سريع
  //تتأكد أن المستخدم لم يُجاوز عدد المحاولات المسموح به.
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            //يفحص هل عدد المحاولات السابقة أقل من 5؟
           //إذا نعم → استمر.
            ///إذا لا → يمنع تسجيل الدخول.


            return;
        }

        event(new Lockout($this));
        //يُرسل حدث قفل الحساب (يمكن استخدامه لتسجيل المحاولة أو التنبيه)

        $seconds = RateLimiter::availableIn($this->throttleKey());
        //يحسب كم ثانية متبقية حتى يُسمح بمحاولة جديدة.
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
        //تُرسل رسالة للمستخدم تفيد أنه تم قفل الحساب مؤقتًا بسبب كثرة المحاولات
    } 

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string //يستخدم البريد وIP المستخدم كمفتاح لمنع التكرار
    {
        //ما الذي تعيده؟

        //تُعيد مفتاح فريد لكل مستخدم/محاولة مبني على:
   //البريد الإلكتروني
//عنوان IP
     


        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
