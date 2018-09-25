@extends('admin.layouts.dashboard')

@section('main-page')
<div class="title">
    <h1>Organizations</h1>
    <hr>
</div>
<div class="portlet light">
    <div class="portlet-title">
        <div class="caption">
            List of Organizations
        </div>
        <div class="actions">
            <a href="{{ route('admin.organization.create') }}" class="btn btn-redtheme"> Add New Organization </a>
        </div>
    </div>
    <div class="portlet-body">
        <div id="tblGovernmentList_wrapper" class="dataTables_wrapper no-footer">
            {!! Form::open(['route' => 'admin.organization.search', 'method' => 'get']) !!}
            <div class="row">
                <div class="col-sm-12">
                    <div id="tblGovernmentList_filter" class="dataTables_filter text-right">
                        <label>Search : {{ Form::text('keyword', request()->keyword , ['class' => 'form-control input-sm input-small input-inline']) }}
                        </label>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="table-scrollable">
                <table class="table table-bordered v-middle dataTable no-footer dtr-inline" id="tblGovernmentList" role="grid" aria-describedby="tblGovernmentList_info">
                    <thead class="red-th">
                        <tr role="row">
                            <th class="sorting">SN</th>
                            <th class="sorting">Organization Name</th>
                            <th class="sorting">Email</th>
                            <th class="sorting">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($organizations as $key => $organization)
                            <tr role="row" class="odd">
                                <td>{{ ($organizations->currentpage()-1)*$organizations->perpage() + 1 + $loop->index }}</td>
                                <td>{{ $organization->name }}</td>
                                <td>{{ $organization->accounts[0]->email }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-theme btn-xs md-skip dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.organization.show', $organization->id) }}">View Organization</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.organization.edit', $organization->id) }}">Edit Organization</a>
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
                <div class="col-4">
                    <div class="pt-2">
                        Showing 
                        @if (($organizations->currentpage()-1)*$organizations->perpage()+1 > $organizations->total())
                            {{ $organizations->total() }}
                        @else
                            {{ ($organizations->currentpage()-1)*$organizations->perpage()+1 }} 
                        @endif
                        to 
                        @if ($organizations->currentpage()*$organizations->perpage() > $organizations->total())
                            {{ $organizations->total() }}
                        @else
                            {{ $organizations->currentpage()*$organizations->perpage() }}
                        @endif
                        of  {{ $organizations->total() }} entries
                    </div>
                    
                </div>
                <div class="col-8">
                    <div class="float-right">
                    {{ $organizations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection