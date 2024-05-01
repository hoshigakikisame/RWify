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
        $socialiteUser = Socialite::driver('google')->user();
        $userInstance = UserModel::where("email", $socialiteUser->getEmail())->first();

        if ($userInstance == null) return $this->failedAuthHandler();

        Auth::login($userInstance, false);

        if (!Auth::user()) return $this->failedAuthHandler();

        // get user by email
        /**
         * @var UserModel $user
         */
        $user = Auth::user();
        $user->redirectToDashboard();

        return redirect()->route("auth.signIn");
    }

    // utility
    private function failedAuthHandler()
    {
        session()->flash('danger', 'Failed to login with Google');
        return redirect()->route("auth.signIn");
    }
}
