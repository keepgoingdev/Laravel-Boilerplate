@extends('admin.layouts.dashboard')

@section('main-page')
<div class="title">
    <h1>Organizations</h1>
    <hr>
</div>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            Edit Organization
        </div>
        <div class="actions">
            <a href="{{ route('admin.organization.index') }}" class="btn btn-redtheme"> Back to List </a>
        </div>
    </div>
    <div class="portlet-body">
        {!! Form::open(['route' => ['admin.organization.update', $organization->id], 'method' => 'put']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('name', 'Organization Name') }}
                        {{ Form::text('name', old('name') == '' ? $organization->name : old('name') , ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Text, Unique', 'required']) }}
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @foreach (range(1, 3) as $i)
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('email', 'Email '.$i) }}
                        {{ Form::text(  'emails[]', 
                                        old('emails.'.$i) == '' ? (isset($organization->accounts[$i-1]) ? $organization->accounts[$i-1]->email : '') : old('emails.'.$i), 
                                        [
                                            'class' => 'form-control'.($errors->has('emails.'.$i) ? ' is-invalid' : ''), 
                                            'placeholder' => 'Enter email'
                                        ]
                                    ) 
                        }}
                        @if ($errors->has('emails.'.$i))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('emails.'.$i) }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('password', 'Password '.$i) }}
                        {{ Form::password('passwords[]', ['class' => 'form-control'.($errors->has('passwords.'.$i) ? ' is-invalid' : ''), 'placeholder' => 'Enter password']) }}
                        @if ($errors->has('passwords.'.$i))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('passwords.'.$i) }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="text-right col-sm-12">
                    <div class="form-group">
                        <br>
                        {{ Form::submit('Save', array('class' => 'btn-theme btn')) }}
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection