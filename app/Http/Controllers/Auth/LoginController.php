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
        return Inertia::render('Auth/Login');
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
        try {
            if (!$telegramData = $telegramLoginAuth->validate($request)) {
                throw new \Exception('Invalid Telegram data');
            }

            $user = User::firstOrCreate(
                ['telegram_id' => $telegramData->getId()],
                [
                    'name' => trim($telegramData->getFirstName() . ' ' . ($telegramData->getLastName() ?? '')),
                    'username' => $telegramData->getUsername() ?? Str::random(8),
                    'password' => bcrypt(Str::random(16))
                ]
            );

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->intended();

        } catch (\Exception $e) {
            return redirect()
                ->route('login')
                ->withErrors(['telegram' => 'فشل تسجيل الدخول عبر Telegram: ' . $e->getMessage()]);
        }
    }
}