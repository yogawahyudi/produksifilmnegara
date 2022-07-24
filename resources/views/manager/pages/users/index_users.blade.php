@extends('manager.master_manager');


@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Data Penyewa</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Data Penyewa</h1> 
@endsection
       
@section('content')
        <div class="row mb-5 mt-5" style="min-height: 70vh">
            <div class="col-12">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No Hp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->no_hp}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Belum ada Penyewa</td>
                                    </tr> 
                                @endforelse                                
                            </tbody>
                        </table>
                    </div>  
                </div>
            </div>
        </div>
@endsection