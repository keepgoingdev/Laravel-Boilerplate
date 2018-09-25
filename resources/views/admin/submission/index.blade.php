@extends('admin.layouts.dashboard')

@section('main-page')
<div class="title">
    <h1>Submissions</h1>
    <hr>
</div>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            List of Submissions
        </div>
        <div class="actions">
            <a href="{{ route('admin.submission.create') }}" class="btn btn-redtheme"> Add New Submission </a>
        </div>
    </div>
    <div class="portlet-body">
        <div id="tblGovernmentList_wrapper" class="dataTables_wrapper no-footer">
            {!! Form::open(['route' => 'admin.submission.search', 'method' => 'get', 'id' => 'search_form']) !!}
                <div class="row">
                    <div class="col-sm-3">
                        <div class="dataTables_length" id="tblSearchBusinessList_length">
                            <label>  
                                {{ Form::text('organization', request()->organization, ['placeholder' => 'Organization', 'class' => 'form-control input-sm input-small input-inline']) }}
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="dataTables_length" id="tblSearchBusinessList_length">
                            <label>  
                            {{ Form::select('year', ['2018' => '2018', '2019' => '2019'], request()->year, ['class' => 'form-control input-sm input-small input-inline', 'placeholder' => 'Select Year']) }}
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="dataTables_length text-right" id="tblSearchBusinessList_length">
                            <label>  
                            {{ Form::selectMonth('month', request()->month, ['class' => 'form-control input-sm input-small input-inline', 'placeholder' => 'Select Month']) }}
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="dataTables_length text-right" id="tblSearchBusinessList_length">
                            <label>  
                            {{ Form::text('keyword', request()->keyword , ['placeholder' => 'Search', 'class' => 'form-control input-sm input-small input-inline']) }}
                            </label>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <div class="table-scrollable">
                <table class="table table-bordered v-middle dataTable no-footer dtr-inline" id="tblGovernmentList">
                    <thead class="red-th">
                        <tr role="row">
                            <th class="sorting">SN</th>
                            <th class="sorting">Organization Name</th>
                            <th class="sorting">Month/Year</th>
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
                            <td>{{ DateTime::createFromFormat('!m', $submission->month)->format('F') }} {{ $submission->year }}</td>
                            <td>{{ $submission->status }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-theme btn-xs md-skip dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.submission.show', $submission->id) }}">View Submission</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.submission.download', $submission->id) }}">Download</a>
                                        </li>
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
                        of  {{ $submissions->total() }} entries
                    </div>
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
