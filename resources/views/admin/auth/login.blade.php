@extends('admin.layouts.app')

@section('content')
    <div class="title">
        <h1>
        ERAS Secure File Transfer System
        </h1>
        <hr>
        <p>
        </p>
    </div>
    <div class="row custom-tabs">
        <div class="col-sm-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        Admin Login
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            {!! Form::open(['route' => 'admin.login', 'method' => 'post']) !!}
                                <div class="form-group">
                                    <label class="control-label" for="email">Email Address</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Enter Email Address" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="password">Password</label>
                                    
                                    <input id="password" type="password" placeholder="Enter Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-theme">Login</button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
