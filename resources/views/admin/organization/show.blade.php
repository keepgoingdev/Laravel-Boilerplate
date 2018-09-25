@extends('admin.layouts.dashboard')

@section('main-page')
<div class="title">
    <h1>Organizations</h1>
    <hr>
</div>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            Show Organization
        </div>
        <div class="actions">
            <a href="{{ route('admin.organization.index') }}" class="btn btn-redtheme"> Back to List </a>
        </div>
    </div>
    <div class="portlet-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('name', 'Organization Name') }}
                        {{ Form::text('name', $organization->name, ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>
            </div>
            @foreach (range(1, 3) as $i)
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('email', 'Email '.$i) }}
                        {{ Form::text(  'emails[]', 
                                        isset($organization->accounts[$i-1]) ? $organization->accounts[$i-1]->email : '', 
                                        [
                                            'class' => 'form-control', 
                                            'disabled'
                                        ]
                                    ) 
                        }}
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div>
@endsection