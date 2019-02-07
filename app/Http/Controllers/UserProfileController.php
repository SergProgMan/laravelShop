<?php

namespace App\Http\Controllers;

use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserProfileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'max:100',
            'street' => 'max:200',
            'city' => 'max:200',
            'phone' => 'max:200',
            'bio' => 'max:1000',
        ]);

        $user = Auth::user();

        if (!$user->profile) {
            $userProfile = new UserProfile;
            $userProfile->user()->associate($user);
        } else {
            $userProfile = $user->profile;
        }

        $userProfile->full_name = $request->full_name;
        $userProfile->street = $request->street;
        $userProfile->city = $request->city;
        $userProfile->phone = $request->phone;
        $userProfile->bio = $request->bio;

        $userProfile->save();
      
        return redirect(route('userProfile.show'))->
            with(['status'=>'Profile updated']);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        return view('userProfile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('userProfile.edit', compact('user'));
    }
}
