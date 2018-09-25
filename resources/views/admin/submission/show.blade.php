@extends('admin.layouts.dashboard')

@section('main-page')
<div class="title">
    <h1>Submissions</h1>
    <hr>
</div>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            Submission Details
        </div>
        <div class="actions">
            <a href="{{ route('admin.submission.index') }}" class="btn btn-redtheme"> Back to List </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label('organization', 'Organization Name') }}
                    {{ Form::select('organization', $organizations, $submission->organization_id, ['class' => 'form-control', 'disabled']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label('year', 'Year') }}
                    {{ Form::number('year', $submission->year, ['class' => 'form-control', 'disabled']) }}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label('month', 'Month') }}
                    {{ Form::selectMonth('month', $submission->month, ['class' => 'form-control', 'disabled']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label('submission_date', 'Submission Date') }}
                    {{ Form::text('submission_date', $submission->created_at, ['class' => 'form-control', 'disabled']) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label('download_status', 'Download Status') }}
                    {{ Form::text('download_status', $submission->download_status, ['class' => 'form-control', 'disabled']) }}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label('download_date', 'Download Date') }}
                    {{ Form::text('download_date', $submission->download_date, ['class' => 'form-control', 'disabled']) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection