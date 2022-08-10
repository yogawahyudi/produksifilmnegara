<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        table {
            border-collapse:collapse ;
            width: 100%;
            }
        th, td {
            padding: 0.25rem;
            text-align: left;
            border: 1px solid #ccc;
            }
    </style>
    <title>Laporan Transaksi</title>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row mb-5">
                    <div class="col-12">
                        <h1><img src="{{asset('assets/images/logo-pfn.png')}}" height="100" width="100" alt="" style="margin-right: 100px">Produksi Film Negara</h1>
                    </div>
                    <hr class="border-end">
                </div>
                <div class="row">
                    <div class="col-10">
                        <div class="row mb-5">
                            <h2 class="text-center">Laporan Transaksi</h2>
                            <h5 class="text-center">{{$data[0]['subtitle']}}</h5>
                        </div>
                        <div class="row mb-5">
                            <table class="zebra">
                                <tbody>
                                    <tr>
                                        <th class="text-center">Total Transaksi</th>
                                        <th class="text-center">{{$data[0]['totalTransaksi']}}</th>
                                    </tr>
                                    <tr>
                                         <th class="text-center">Transaksi Dibatalkan</th>
                                        <th class="text-center">{{$data[0]['transaksiDibatalkan']}}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Total User</th>
                                        <th class="text-center">{{$data[0]['totalUser']}}</th>                                    
                                    </tr>
                                    <tr>
                                        <th class="text-center">User Baru</th>
                                       <th class="text-center">{{$data[0]['totalUserBaru']}}</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Pendapatan</th>
                                        <th class="text-center">{{number_format($data[0]['totalPendapatan'],2,',','.')}}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <table class="zebra">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Id Transaksi</th>
                                        <th class="text-center">Tanggal Transaksi</th>
                                        <th class="text-center">Tanggal Sewa</th>                                        
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Nama Perusahaan</th>
                                        <th class="text-center">Studio</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                     $no = 1;   
                                    @endphp
                                        @foreach ($data[0]['detailTransaksi'] as $item)
                                        <tr>
                                            <td class="text-center" rowspan="{{count($item['transaksi_items'])}}">{{$no}}</td>
                                            <td class="text-center" rowspan="{{count($item['transaksi_items'])}}">{{$item['id']}}</td>
                                            <td class="text-center" rowspan="{{count($item['transaksi_items'])}}">{{$item['tanggal']}}</td>
                                            <td class="text-center">{{$item['transaksi_items'][0]['tanggal']}}</td>
                                            <td class="text-center" rowspan="{{count($item['transaksi_items'])}}">{{$item['nama']}}</td>                                        
                                            <td class="text-center" rowspan="{{count($item['transaksi_items'])}}">{{$item['nama_per']}}</td>
                                            <td class="text-center">{{$item['transaksi_items'][0]['studio']}}</td>
                                            <td class="text-center">{{$item['transaksi_items'][0]['t_harga']}}</td>
                                        </tr>
                                        @for($i = 1 ; $i < count($item['transaksi_items']); $i++)
                                        <tr>
                                            <td class="text-center">{{$item['transaksi_items'][$i]['tanggal']}}</td>                                            
                                            <td class="text-center">{{$item['transaksi_items'][$i]['studio']}}</td>
                                            <td class="text-center">{{$item['transaksi_items'][$i]['t_harga']}}</td>
                                        </tr>
                                        @endfor
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>