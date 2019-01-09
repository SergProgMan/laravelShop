@extends('layouts.menu')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $user->name }}'s profile</div>    
                    <div class="panel-body">
    

                        @include ('backOffice._errors_list')
                        
                        <div class="form-horizontal">
                            
                            <div class="form-group">
                                <label for="country" class="col-md-4 control-label">Country</label>
                                <div class="col-md-6">
                                    <input id="country" 
                                        type="text" 
                                        class="form-control" 
                                        name="country" 
                                        value="{{ $userProfile->country ?? null }}" required>
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label for="city" class="col-md-4 control-label">City</label>
                                <div class="col-md-6">
                                    <input id="city" 
                                        type="text" 
                                        class="form-control" 
                                        name="city" 
                                        value="{{ $userProfile->city ?? null }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Address</label>
                                <div class="col-md-6">
                                    <input id="address" 
                                        type="text" 
                                        class="form-control" 
                                        name="address" 
                                        value="{{  $userProfile->address ?? null }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Phone</label>
                                <div class="col-md-6">
                                    <input id="phone" 
                                        type="text" 
                                        class="form-control" 
                                        name="phone" 
                                        value="{{ $userProfile->phone ?? null }}" required>
                                </div>
                            </div>                                
                        </div>
                    </div>
                </div>
                <a class="btn btn-default btn-primary"
                    href="{{ route('userProfile.edit', $user)}}">Save</a>
            </div>
        </div>
    </div>
</div>
@endsection