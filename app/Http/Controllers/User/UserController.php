<?php

namespace App\Http\Controllers\User;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModel;

class UserController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function profile()
    {
        $user = Auth::user();

        return view('user/profile', compact('user'));
    }

    public function updateProfile()
    {
        request()->validate([
            'email' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
        ]);

        /** @var UserModel $user */
        $user = Auth::user();

        if(!$user) {
            session()->flash('danger', 'Update Failed.');
        } else {

            // if email is different, reset email verification
            if ($user->email != request()->email) {
                $user->setEmailVerifiedAt(null);
                $user->email = request()->email;
            }
            
            // update other fields
            $user->setPekerjaan(request()->pekerjaan);
            $user->setAlamat(request()->alamat);

            $user->save();

            session()->flash('success', 'Update Success.');
        }

        return redirect()->route('user.profile.index');
    }

    public function sendVerificationEmail()
    {
        /*
        * @var UserModel $user
        */
        $user = request()->user();
        $user->sendEmailVerificationNotification();

        session()->flash('success', 'Verification email sent.');

        return redirect()->route('user.profile.index');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        // $request->fulfill();

        session()->flash('success', 'Email verified.');

        return redirect()->route('user.profile.index');
    }
}
