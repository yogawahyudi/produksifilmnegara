@extends('assets.master_assets')

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
                <a href="{{route('index.transaksi')}}" type="button" class="btn btn-link"><i class="bx bx-left-arrow-alt bx-md text-dark"></i></a>
            </div>
       </div>
       <div class="row mb-3 border-bottom border-2 border-secondary">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-6">
                        <p>Nama</p>
                        <p>Email</p>
                        <p>No Hp</p>
                    </div>
                    <div class="col-6">
                        <p>: Yoga</p>
                        <p>: Yogawhy8@gmail.com</p>
                        <p>: 082213462424</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="row">
                    <div class="col-6">
                        <p>Nama Perusahaan</p>
                        <p>Email Perusahaan</p>
                        <p>No Hp Perusahaan</p>
                    </div>
                    <div class="col-6">
                        <p>: Yoga</p>
                        <p>: Yogawhy8@gmail.com</p>
                        <p>: 082213462424</p>
                    </div>
                </div>
            </div>
       </div>
       <div class="row">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td class="text-start">Studio</td>
                    <td class="text-center">Studio 1</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td class="text-start">Tanggal</td>
                    <td class="text-center">22-10-2022</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td class="text-start">Durasi shooting</td>
                    <td class="text-center" >15 Jam</td>
                    <td class="text-center">Overcharge 3 Jam</td>
                    <td class="text-center"></td>
                </tr> 
                <tr>
                    <td class="text-start">Durasi Setting</td>
                    <td class="text-center">12 Jam</td>
                    <td class="text-center">Overcharge 0 Jam</td>
                    <td class="text-center"></td>
                </tr>
                <tr>
                    <td class="text-start">Harga Shooting / 12 Jam</td>
                    <td class="text-center">Rp. 6.000.000 </td>
                    <td class="text-center"> x 1</td>
                    <td class="text-center">Rp. 6.000.000</td>
                </tr>
                <tr>
                    <td class="text-start">Harga Setting / 12 Jam</td>
                    <td class="text-center">Rp. 3.000.000</td>
                    <td class="text-center"> x 1</td>
                    <td class="text-center">Rp. 3.000.000</td>
                </tr>
                <tr>
                    <td class="text-start">Harga Overcharge Shooting / Jam</td>
                    <td class="text-center">Rp 500.000 </td>
                    <td class="text-center"> x 3</td>
                    <td class="text-center">Rp 1.500.000</td>
                </tr>
                <tr>
                    <td class="text-start">Harga Overcharge Setting / Jam</td>
                    <td class="text-center">Rp. 300.000</td>
                    <td class="text-center"> x 0 </td>
                    <td class="text-center">Rp. 0</td>                    
                </tr>
            </tbody>
            <tfoot class="bg-dark text-white">
                <tr>
                    <td class="text-start" colspan="3">Subtotal</td>
                    <td class="tetxt-center">Rp. 10.500.000</td>
                </tr>
            </tfoot>
        </table>
        <div class="col-6">
            
           
        </div>
        <div class="col-6">
            
        </div>
       </div>
       <div class="row">
        <div class="col-6"></div>
        <div class="col-6"></div>
       </div>
    </div>
@endsection