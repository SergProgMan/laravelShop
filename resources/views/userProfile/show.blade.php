@extends('layouts.menu')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $user->name }}'s profile</div>    
                    <div class="panel-body">
    
                        {{-- @include ('backOffice._session_status')
                        @include ('backOffice._errors_list') --}}
                        <div class="form-horizontal">
                            
                            <div class="form-group">
                                <label for="country" class="col-md-4 control-label">Country</label>
                                <p id="country" class="col-md-6">{{ $userProfile->country ?? "You need to add information" }}</p>
                            </div>
                                
                            <div class="form-group">
                                <label for="city" class="col-md-4 control-label">City</label>
                                <p class="col-md-6">{{ $userProfile->city ?? "You need to add information" }}</p>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Address</label>
                                <p class="col-md-6">{{ $userProfile->address ?? "You need to add information" }}</p>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Phone</label>
                                <p class="col-md-6">{{ $userProfile->phone ?? "You need to add information" }}</p>
                            </div>                                
                        </div>
                    </div>
                </div>
                <a class="btn btn-default btn-primary"
                    href="{{ route('userProfile.edit', $user)}}">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection