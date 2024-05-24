<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function signInPage()
    {
        return view('pages.auth.signin');
    }

    public function signIn()
    {
        // get username and password
        $email = request()->input("email");
        $password = request()->input("password");

        $authenticated = Auth::attempt(["email" => $email, "password" => $password]);

        if (!$authenticated) {
            session()->flash('danger',['title' => "Auth Failed", 'description' => "Invalid email or password"]);
            return redirect()->route("auth.signInPage");
        }

        // get user by email
        /**
         * @var UserModel $user
         */
        $user = Auth::user();
        $user->redirectToDashboard();

        return redirect()->route("auth.signIn");
    }

    public function googleSignInInitial()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleSignInReceiver()
    {
        return "test";
    }

    public function forgotPasswordPage()
    {
        return view('pages.auth.forgotPassword');
    }

    public function forgotPassword()
    {
        request()->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordPage(string $token)
    {
        return view('pages.auth.resetPassword', compact('token'));
    }

    public function resetPassword()
    {
        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);
                
                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status != Password::PASSWORD_RESET) {
            session()->flash('danger',['title' => __($status), 'description' => __($status)]);
            return back()->withInput(request()->only('email'));
        }

        return redirect()->route('auth.signInPage')->with('status', __($status));
    }

    public function signOut() {
        Auth::logout();
        return redirect()->route('auth.signInPage');
    }  
}
