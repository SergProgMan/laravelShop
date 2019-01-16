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
            'country' => 'max:200',
            'city'=>'max:200',
            'address'=>'max:200',
            'phone'=>'max:200',
        ]);

        $user = Auth::user();

        if(!$user->userProfile){
            $userProfile =new UserProfile;
            $userProfile->user()->associate($user);
        } else {
            $userProfile = $user->userProfile;
        }
        
        $userProfile->country = $request->country;
        $userProfile->city = $request->city;
        $userProfile->address = $request->address;
        $userProfile->phone = $request->phone;

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
