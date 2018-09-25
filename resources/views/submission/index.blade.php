@extends('layouts.dashboard')

@section('main-page')
<div class="title">
    <h1>Submissions</h1>
    <hr>
</div>
@if (isset($data) && $data == 'create')
    <div class="alert alert-success">
        <strong>Success!</strong> Submission created.
    </div>
@endif
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            List of Submissions
        </div>
        <div class="actions">
            <a href="{{ route('submission.create') }}" class="btn btn-redtheme"> Add New Submission </a>
        </div>
    </div>
    <div class="portlet-body">
        <div id="tblGovernmentList_wrapper" class="dataTables_wrapper no-footer">
            {!! Form::open(['route' => 'submission.search', 'method' => 'get', 'id' => 'search_form']) !!}
                <div class="row">
                    <div class="col-sm-4">
                        <div class="dataTables_length" id="tblSearchBusinessList_length">
                            <label>  
                            {{ Form::select('year', ['2018' => '2018', '2019' => '2019'], request()->year, ['class' => 'form-control input-sm input-small input-inline', 'placeholder' => '']) }}
                            Year
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div id="tblSearchBusinessList_filter" class="dataTables_filter">
                            <label>Month : 
                            {{ Form::selectMonth('month', request()->month, ['class' => 'form-control input-sm input-small input-inline', 'placeholder' => '']) }}
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div id="tblSearchBusinessList_filter" class="dataTables_filter">
                            <label>Search : 
                                {{ Form::text('keyword', request()->keyword , ['class' => 'form-control input-sm input-small input-inline']) }}
                            </label>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <div class="table-scrollable">
                <table class="table table-bordered v-middle dataTable no-footer dtr-inline" id="tblGovernmentList">
                    <thead class="red-th">
                        <tr role="row">
                            <th class="sorting" style="width: 50px;">SN</th>
                            <th class="sorting">Organization Name</th>
                            <th class="sorting text-right">Month/Year</th>
                            <th class="sorting">Submission Status</th>
                            <th class="sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($submissions as $key=> $submission)
                        <tr role="row" class="odd">
                            <td>
                                {{ ($submissions->currentpage()-1)*$submissions->perpage() + $loop->index + 1 }}
                            </td>   
                            <td>
                                    {{ $submission->organization->name }}
                            </td>
                            <td class="text-right">{{  DateTime::createFromFormat('!m', $submission->month)->format('F') }} {{ $submission->year }}</td>
                            <td>{{ $submission->status }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-theme btn-xs md-skip dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('submission.show', $submission->id) }}">View Submission</a>
                                        </li>
                                        @if ($submission->download_status != "Downloaded")
                                        <li>
                                            <a class="dropdown-item" href="{{ route('submission.edit', $submission->id) }}">Edit Submission</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="pt-2">
                        Showing 
                        @if (($submissions->currentpage()-1)*$submissions->perpage()+1 > $submissions->total())
                            {{ $submissions->total() }}
                        @else
                            {{ ($submissions->currentpage()-1)*$submissions->perpage()+1 }} 
                        @endif
                        to 
                        @if ($submissions->currentpage()*$submissions->perpage() > $submissions->total())
                            {{ $submissions->total() }}
                        @else
                            {{ $submissions->currentpage()*$submissions->perpage() }}
                        @endif
                        of  {{ $submissions->total() }} entries</div>
                    
                </div>
                <div class="col-sm-8">
                    <div class="pull-right">
                        {{ $submissions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("input[name='keyword']").keypress(function( event ) {
        if ( event.which == 13 ) {
            $('#search_form').submit();
        }
    });
    $("input[name='organization']").keypress(function( event ) {
        if ( event.which == 13 ) {
            $('#search_form').submit();
        }
    });
    $( "select[name='year']" ).change(function() {
        $('#search_form').submit();
    });
    
    $( "select[name='month']" ).change(function() {
        $('#search_form').submit();
    });
</script>
@endsection
