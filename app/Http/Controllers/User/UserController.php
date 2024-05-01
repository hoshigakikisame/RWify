<?php

namespace App\Http\Controllers\User;

// Illuminate
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModel;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UserController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function profile()
    {
        $user = Auth::user();

        return view('pages.user.profile', compact('user'));
    }

    public function updateProfileImage() {
        request()->validate([
            'image' => "required|image|mimes:" . config('cloudinary.allowed_mimes')
        ]);
        
        /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
        $cloudinaryResponse = Cloudinary::upload(request()->file('image')->getRealPath());
        $resultUrl = $cloudinaryResponse->getSecurePath();
        
        $user = request()->user();

        $user->setImageUrl($resultUrl);
        $user->save();

        return redirect()->route('user.profile.index');
    }

    public function updateProfile()
    {
        request()->validate([
            'email' => 'required',
            'pekerjaan' => 'required',
            'alamat' => 'required',
        ]);

        $res = Cloudinary::upload(request()->file('image')->getRealPath());
        dd($res);

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

    public function updatePassword()
    {
        request()->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'new_password_confirmation' => 'required',
        ]);

        /** @var UserModel $user */
        $user = Auth::user();

        if(!$user) {
            session()->flash('danger', 'Update Failed.');
        } else {
            if (request()->new_password != request()->new_password_confirmation) {
                session()->flash('danger', 'Update Failed - Passwords do not match.');
            } else if (!password_verify(request()->current_password, $user->getPassword())) {
                session()->flash('danger', 'Update Failed - Current password is incorrect.');
            } else {
                $newPassword = Hash::make(request()->new_password);
                $user->setPassword($newPassword);
                $user->save();

                session()->flash('success', 'Update Success.');
            }
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
