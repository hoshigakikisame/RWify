<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function signInPage()
    {
        return view('auth.signin');
    }

    public function signIn()
    {
        // get username and password
        $email = request()->input("email");
        $password = request()->input("password");

        $authenticated = Auth::attempt(["email" => $email, "password" => $password]);

        if (!$authenticated) {
            return redirect()->back()->with("error", "Invalid username or password");
        }

        // get user by email
        /**
         * @var UserModel $user
         */
        $user = Auth::user();

        switch($user->getRole()) {
            case "Ketua Rukun Warga":
                return redirect()->route('rw.dashboard');
            case "Ketua Rukun Tetangga":
                return "Ketua RT";
            case "Warga":
                return "Warga";
        }

        return redirect()->route("auth.signIn");
    }

    public function forgotPassword()
    {
        return "Forgot password";
    }

    public function signOut() {
        Auth::logout();
        return redirect()->route('auth.signInPage');
    }  
}
