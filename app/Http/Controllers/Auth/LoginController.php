<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Azate\LaravelTelegramLoginAuth\TelegramLoginAuth; // إضافة للحزمة
use App\Models\User; // إضافة لنموذج المستخدم
use Illuminate\Support\Str; // لتوليد كلمة مرور عشوائية إذا لزم

class LoginController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'telegramCallbackUrl' => route('telegram.callback'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function destroy() {
        Auth::logout();

        return redirect()->route('login');
    }

    // دالة جديدة لمعالجة تسجيل الدخول عبر Telegram
   public function telegramCallback(TelegramLoginAuth $telegramLoginAuth, Request $request): RedirectResponse
{
    if ($telegramData = $telegramLoginAuth->validate($request)) {
        $user = User::where('telegram_id', $telegramData->getId())->first();

        if (!$user) {
            $user = User::create([
                'telegram_id' => $telegramData->getId(),
                'name' => $telegramData->getFirstName() . ($telegramData->getLastName() ? ' ' . $telegramData->getLastName() : ''),
                'username' => $telegramData->getUsername(),
                'email' => null, // أضف هذا للتأكيد
                'password' => bcrypt(Str::random(16)),
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/'); // أو Inertia::location('/') إذا استمرت مشكلة التوجيه
    }

    return redirect()->route('login')->withErrors(['telegram' => 'فشل تسجيل الدخول عبر Telegram.']);
}
}