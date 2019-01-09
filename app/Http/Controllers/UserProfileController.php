<?php

namespace App\Http\Controllers;

use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserProfileController extends Controller
{
    // public function __construct()
    // {
    //     // $user = Auth::user();
    //     //$userProfile = $user->userProfile();

    //     if(!$userProfile->exists()){

    //         $userProfile = UserProfile::create();
    //         $userProfile -> user_id = $user->id;
    //         $userProfile -> save();
    //     } 
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $userProfile = $user->userProfile();
       
        // //create empty userProfile
        // if(!$userProfile->exists()){
        //     dd('exist!');
        // } else 
        return view('userProfile.show', compact(['userProfile','user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();
        $userProfile = $user->userProfile();
        return view('userProfile.edit', compact(['userProfile','user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
