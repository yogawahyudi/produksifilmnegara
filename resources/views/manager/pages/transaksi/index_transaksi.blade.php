@extends('manager.master_manager')

@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Transaksi</h1> 
@endsection

@section('content')
    <div class="container-fluid">
        @include('alert.alert')
       <div class="row mb-5 mt-5">
            <div class="col-12">
                <a href="{{route('create.transaksi')}}" type="button" class="btn btn-danger"><i class="bx bx-plus"></i>Transaksi</a>
            </div>
       </div>
       <div class="row">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Nama Perusahaan</th>
                            <th>No Hp</th>
                            <th>Tanggal</th>
                            <th>Studio</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Yoga</td>
                            <td>Dxcode</td>
                            <td>082213462424</td>
                            <td>22-10-2022</td>
                            <th>Studio</th>                            
                            <td><span class="badge bg-primary">Berlangsung<span></span></span></td>
                            <td>
                                <a href={{route('view.manager.transaksi', 1)}} class="btn btn-link">
                                    <i class="bx bx-show-alt bx-fw text-primary"></i></td>
                                </a>
                        </tr>
                          <tr>
                            <td>Yoga</td>
                            <td>Dxcode</td>
                            <td>082213462424</td>
                            <td>22-10-2022</td>
                            <th>Studio</th>                        
                            <td><span class="badge bg-success">Selesai<span></span></span></td>
                            <td>
                                <a href={{route('view.manager.transaksi', 1)}} class="btn btn-link">
                                    <i class="bx bx-show-alt bx-fw text-primary"></i></td>
                                </a>
                        </tr>
                          <tr>
                            <td>Yoga</td>
                            <td>Dxcode</td>
                            <td>082213462424</td>
                            <td>22-10-2022</td>
                            <th>Studio</th>
                            <td><span class="badge bg-danger">Dibatalkan<span></span></span></td>
                            <td>
                                <a href={{route('view.manager.transaksi', 1)}} class="btn btn-link">
                                    <i class="bx bx-show-alt bx-fw text-primary"></i></td>                    
                                </a>
                        </tr>
                    </tbody>
                </table>
            </div>
       </div>
    </div>
@endsection