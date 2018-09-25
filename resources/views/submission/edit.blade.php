@extends('layouts.dashboard')

@section('main-page')
<div class="title">
    <h1>Submissions</h1>
    <hr>
</div>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            Edit Submission
        </div>
        <div class="actions">
            <a href="{{ route('submission.index') }}" class="btn btn-redtheme"> Back to List </a>
        </div>
    </div>
    <div class="portlet-body">
        {!! Form::open(['route' => ['submission.update', $submission->id], 'method' => 'put', 'files' => true]) !!}
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('organization', 'Organization Name') }}
                        {{ Form::text('organization', $organization, ['class' => 'form-control', 'readonly']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('year', 'Year') }}
                        <div class="btn-group bootstrap-select form-control bs-select">
                        {{ Form::selectRange('year', 2018, 2019, $submission->year,  ['class' => 'form-control bs-select'.($errors->has('year') ? ' is-invalid' : '')]) }}
                        </div>
                        @if ($errors->has('year'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('year') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('month', 'Month') }}
                        <div class="btn-group bootstrap-select form-control bs-select">                            
                            {{ Form::selectMonth('month', $submission->month, ['class' => 'form-control bs-select'.($errors->has('month') ? ' is-invalid' : '')]) }}
                        </div>
                        
                        @if ($errors->has('month'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('month') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        {{ Form::label('file', 'File Upload') }}
                        <div class="form-inline">
                            {{ Form::text('file_name', '', ['class' => 'form-control', 'disabled', 'id' => 'file-name']) }}
                            {{ Form::button('Select file', ['class' => 'form-control', 'id' => 'file-open']) }}
                            {{ Form::file('file', ['accept' => '.xlsx, .csv, .xls', 'id' => 'file', 'class' => 'hidden form-control'.($errors->has('file') ? ' is-invalid' : '')]) }}
                            <br>
                            @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="text-right col-sm-12">
                    <div class="form-group">
                        <br>
                        <button type="submit"  class="btn-theme btn"> Save </button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<script>
    $('#file-open').click(function() {
        $('#file').trigger('click');
    });

    $('#file').change(function(e){
        var fileName = e. target. files[0]. name;
        $('#file-name').val(fileName);
    });
</script>
@endsection