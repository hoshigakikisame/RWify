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

    public function updateProfileImage()
    {
        request()->validate([
            'image' => "required|image|mimes:" . config('cloudinary.allowed_mimes')
        ]);

        /** @var \CloudinaryLabs\CloudinaryLaravel\Model\Media $cloudinaryResponse */
        $cloudinaryResponse = Cloudinary::upload(request()->file('image')->getRealPath());
        $resultUrl = $cloudinaryResponse->getSecurePath();

        $user = request()->user();

        $user->setImageUrl($resultUrl);
        $user->save();
        session()->flash('success',['title' => 'Update Image Profile Success', 'description' => 'Update Image Profile Success']);

        return "Update Image Profile";
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

        if (!$user) {
            session()->flash('danger',['title' => 'Update Failed.', 'description' => 'Update Failed.']);
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

            session()->flash('success',['title' => 'Update Success.', 'description' => 'Update Success.']);
        }

        return  'Update User Profile';
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

        if (!$user) {
            session()->flash('danger',['title' => 'Update Failed.', 'description' => 'Update Failed.']);
        } else {
            if (request()->new_password != request()->new_password_confirmation) {
                session()->flash('danger',['title' => 'Update Failed - Passwords do not match.', 'description' => 'Update Failed - Passwords do not match.']);
            } else if (!password_verify(request()->current_password, $user->getPassword())) {
                session()->flash('danger',['title' => 'Update Failed - Current password is incorrect.', 'description' => 'Update Failed - Current password is incorrect.']);
            } else {
                $newPassword = Hash::make(request()->new_password);
                $user->setPassword($newPassword);
                $user->save();

                session()->flash('success',['title' => 'Update Success.', 'description' => 'Update Success.']);
            }
        }

        return 'Update Password';
    }

    public function sendVerificationEmail()
    {
        /*
        * @var UserModel $user
        */
        $user = request()->user();
        $user->sendEmailVerificationNotification();

        session()->flash('success',['title' => 'Verification email sent.', 'description' => 'Verification email sent.']);

        return redirect()->route('user.profile.index');
    }

    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        // $request->fulfill();

        session()->flash('success',['title' => 'Email verified.', 'description' => 'Email verified.']);

        return redirect()->route('user.profile.index');
    }
}
