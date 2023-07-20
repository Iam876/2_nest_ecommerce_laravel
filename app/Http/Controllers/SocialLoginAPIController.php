<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginAPIController extends Controller
{
    public function goToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function storeGoogleData()
    {
        $GoogleUser = Socialite::driver('google')->user();
        // dd($GoogleUser->user['name']);
        $user = User::where('sid', $GoogleUser->user['id'])->first();
        if ($user != null) {
            Auth::login($user);
            $notification = array(
                'message' => 'You have login successfully',
                'alert-type' => 'success'
            );
            return redirect(RouteServiceProvider::HOME)->with($notification);
        } else {
            $user = User::create([
                'name' => $GoogleUser->user['name'],
                'sid' => $GoogleUser->user['id'],
                'username' => $GoogleUser->user['given_name'],
                'email' => $GoogleUser->user['email'],
                'password' => Hash::make(Str::random(20)),
                'photo' => $GoogleUser->user['picture']
            ]);
            $sid = $GoogleUser->user['id'];
            return view('auth.setPassword', compact('sid'));
        }
    }

    public function setPassword(Request $request, $sid)
    {
        if ($request->password === $request->password_confirmation) {
            $user = User::where('sid', $sid)->first();
            $user->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ]);
            Auth::login($user);
            $notification = array(
                'message' => 'You have login successfully',
                'alert-type' => 'success'
            );
            return redirect(RouteServiceProvider::HOME)->with($notification);
        }
    }

    public function goToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function storeFacebookData()
    {
        $FacebookUser = Socialite::driver('facebook')->user();
        // dd($FacebookUser->avatar);

        $user = User::where('sid', $FacebookUser->user['id'])->first();
        if ($user != null) {
            Auth::login($user);
            $notification = array(
                'message' => 'You have login successfully',
                'alert-type' => 'success'
            );
            return redirect(RouteServiceProvider::HOME)->with($notification);
        } else {
            $user = User::create([
                'sid' => $FacebookUser->user['id'],
                'username' => $FacebookUser->user['name'],
                'name' => $FacebookUser->user['name'],
                'email' => $FacebookUser->user['email'],
                'password' => Hash::make(Str::random(20)),
                'photo' => $FacebookUser->avatar
            ]);
            $sid = $FacebookUser->user['id'];
            return view('auth.setPassword', compact('sid'));
        }
    }
    public function goToGithub()
    {
        return Socialite::driver('github')->redirect();
    }
    public function storeGithubData()
    {
        $GithubUser = Socialite::driver('github')->user();
        // dd($GithubUser);

        $user = User::where('sid', $GithubUser->user['id'])->first();
        if ($user != null) {
            Auth::login($user);
            $notification = array(
                'message' => 'You have login successfully',
                'alert-type' => 'success'
            );
            return redirect(RouteServiceProvider::HOME)->with($notification);
        } else {
            $user = User::create([
                'sid' => $GithubUser->user['id'],
                'username' => $GithubUser->nickname,
                'name' => $GithubUser->nickname,
                'email' => $GithubUser->user['email'],
                'password' => Hash::make(Str::random(20)),
                'photo' => $GithubUser->user['avatar_url']
            ]);
            $sid = $GithubUser->user['id'];
            return view('auth.setPassword', compact('sid'));
        }
    }
}
