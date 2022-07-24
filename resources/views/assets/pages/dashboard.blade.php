@extends('assets.master_assets')

@section('content')
    <h3>Hello, {{Auth::guard('assets')->user()->name}}</h3>
@endsection