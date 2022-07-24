@extends('manager.master_manager')

@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Dashboard</h1> 
@endsection

@section('content')
<div class="contaier-fluid">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4  d-flex align-items-end">
                            <i class="bx bx-user bx-lg text-primary fs-1"></i>
                        </div>
                        <div class="col-8">
                            <div class="row mb-3">
                                <h5 class="card-text">Total User</h5>
                            </div>
                            <div class="row">
                                <h1 class="fs-1">5</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4  d-flex align-items-end">
                            <i class="bx bx-spreadsheet bx-lg text-primary fs-1"></i>
                        </div>
                        <div class="col-8">
                            <div class="row mb-3">
                                <h5 class="card-text">Transaksi</h5>
                            </div>
                            <div class="row">
                                <h1 class="fs-1">3</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4  d-flex align-items-end">
                            <i class="bx bx-spreadsheet bx-lg text-danger fs-1"></i>
                        </div>
                        <div class="col-8">
                            <div class="row mb-3">
                                <h5 class="card-text">Transaksi Dibatalkan</h5>
                            </div>
                            <div class="row">
                                <h1 class="fs-1">1</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4  d-flex align-items-end">
                            <i class="bx bx-credit-card bx-lg text-primary fs-1"></i>
                        </div>
                        <div class="col-8">
                            <div class="row mb-3">
                                <h5 class="card-text">Hari Ini</h5>
                            </div>
                            <div class="row">
                                <h1 class="fs-5">Rp 7.500.000</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4  d-flex align-items-end">
                            <i class="bx bx-credit-card bx-lg text-primary fs-1"></i>
                        </div>
                        <div class="col-8">
                            <div class="row mb-3">
                                <h5 class="card-text">Bulan Ini</h5>
                            </div>
                            <div class="row">
                                <h1 class="fs-5">Rp. 10.500.000</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4  d-flex align-items-end">
                            <i class="bx bx-credit-card bx-lg text-danger fs-1"></i>
                        </div>
                        <div class="col-8">
                            <div class="row mb-3">
                                <h5 class="card-text">Tahun Ini</h5>
                            </div>
                            <div class="row">
                                <h1 class="fs-5">Rp. 18.000.000</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection