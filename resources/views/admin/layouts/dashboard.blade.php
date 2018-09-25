@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-3">
            @include('admin.layouts.sidebar')
        </div>
        <div class="col-sm-9">
            @yield('main-page')
        </div>
    </div>
@endsection