<?php

namespace App\Http\Controllers\Auth\OAuth;
// Illuminate
use Illuminate\Support\Facades\Auth;
// Laravel
use Laravel\Socialite\Facades\Socialite;
// App
use App\Http\Controllers\Controller;
use App\Models\UserModel;


class GoogleOAuthController extends Controller
{

    public function index()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        if (request()->has("error")) {
            return redirect()->back()->with("error", "Failed to login with Google");
        }

        $socialiteUser = Socialite::driver('google')->user();
        $user = UserModel::where("email", $socialiteUser->getEmail())->first();

        Auth::login($user, false);

        if (!Auth::user()) {
            return redirect()->back()->with("error", "Failed to login with Google");
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
}
