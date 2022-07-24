@extends('admin.master_admin')

@section('content')
    <h3>Hello, {{Auth::guard('admin')->user()->name}}</h3>
@endsection