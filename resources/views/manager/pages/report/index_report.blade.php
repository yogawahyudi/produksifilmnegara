@extends('manager.master_manager');

@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Laporan</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Laporan</h1> 
@endsection
       
@section('content')
        <div class="row mb-5 mt-5" style="min-height: 70vh">
            <div class="col-12 justify-content-between">
                <div class="row mb-5 align-items-center">
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-sm-3">
                        <select name="period" id="period" class="form-select">
                            <option value="w" checked>Weekly</option>
                            <option value="m">Monthly</option>
                            <option value="y">Yearly</option>                            
                        </select>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="input-group input-daterange">
                                    <div class="input-group-text"><i class="bx bx-calendar"></i></div>                                    
                                    <input type="text" class="form-control" id="start" name="start" value="">
                                    <div class="input-group-text">-</div>
                                    <input type="text" class="form-control" id="end" name="end" value="">
                                    <div class="input-group-text">
                                        <button class="btn btn-outline-danger btn-sm" id="tampil">Tampilkan</button>
                                    </div>                                                                        
                                </div>                        
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-12">
                        <div class="row mb-5">
                            <h2 class="text-center">Laporan Transaksi</h2>
                            <h5 class="text-center" id="subtitle"></h5>
                        </div>
                    </div>
                </div>
                <div class="row mb-5"  id="laporan-wrapper">
                    <div class="col-12">
                        <div class="row mb-5 justify-content-between  justify-content-sm-center">
                            <div class="col-lg-4 col-md-4 col-sm-8 mb-3">
                                <div class="card card-body shadow">
                                    <div class="row">
                                        <h4 class="card-title text-center mb-3"> Total Transaksi</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12"><i class='bx bx-spreadsheet bx-lg text-center'></i></div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <h1 class="text-center" id="transaksi"></h1>                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 mb-3">
                                <div class="card card-body shadow">
                                    <div class="row">
                                        <h4 class="card-title text-center mb-3"> Transaksi dibatalkan</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12"><i class='bx bx-spreadsheet bx-lg text-center'></i></div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <h1 class="text-center" id="transaksicancel"></h1>                                                
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-8 mb-3">
                                <div class="card card-body shadow">
                                    <div class="row">
                                        <h4 class="card-title text-center mb-3">Total User</h4>
                                    </div>                                    
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12"><i class='bx bx-user bx-lg text-center'></i></div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <h1 class="text-center" id="user"></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-4 col-md-4 col-sm-8 mb-3">
                                <div class="card card-body shadow">
                                    <div class="row">
                                        <h4 class="card-title text-center mb-3">Total User Baru</h4>
                                    </div>                                    
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12"><i class='bx bx-user bx-lg text-center'></i></div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <h1 class="text-center" id="userBaru"></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-lg-6 col-md-6 col-sm-8 mb-3">
                                <div class="card card-body shadow">
                                    <div class="row">
                                        <h4 class="card-title text-center mb-3">Pendapatan</h4>
                                    </div>                                    
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-sm-12"><i class='bx bx-credit-card bx-lg text-center'></i></div>
                                        <div class="col-md-6 col-lg-6 col-sm-12">
                                            <h1 class="text-center" id="pendapatan"></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="card card-body table-responsive">
                                <div class="col-12">
                                    <form action="/manager/dashboard/report/pdf" method="post">
                                        @csrf
                                        <input type="hidden" name="id">
                                        <input type="hidden" name="start">
                                        <input type="hidden" name="end">
                                        <button type="submit" class="btn btn-outline-danger float-end mb-3"><i class="bx bx-save bx-fw"></i> as PDF</button>
                                    </form>
                                    <table class="table table-striped align-middle">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Id Transaksi</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Tanggal Sewa</th>                                    
                                                <th>Nama</th>
                                                <th>Nama Perusahaan</th>
                                                <th>Studio</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('document').ready(()=>{
                var startDate;
                var endDate;
                let period = $('select#period').val();

                const getReport = (period) => {
                    let date = [];
                    let transaksi =[];
                    let no = 1;
                    
                    $('#laporan-wrapper').append('<div class="col-12 card card-body shadow"  id="chart"></div>')
                    $.ajax({
                        url: '/manager/dashboard/report/' + period,
                        method: 'GET',
                        success: (data) => {
                            data = JSON.parse(data);
                            console.log(data);
                            $.each(data['data'], (val) => {
                                date = [ ...date, data['data'][val]['date']] 
                                transaksi = [ ...transaksi, data['data'][val]['transaksi']] 
                            })  
                            $('input[name="id"]').val(period);
                            $('#transaksi').text(data['totalTransaksi']);
                            $('#transaksicancel').text(data['transaksiDibatalkan']);
                            $('#user').text(data['totalUser']);
                            $('#pendapatan').text(data['totalPendapatan']);
                            $('#userBaru').text(data['totalUserBaru']);
                            $('#subtitle').text(data['subtitle']);                            
                            
                            if(data['totalTransaksi'] !== 0){
                                $('#transaksi').addClass('text-success');
                            }
                              if(data['transaksiDibatalkan'] !== 0){
                                $('#transaksicancel').addClass('text-danger');
                            }
                              if(data['totalPendapatan'] !== 0){
                                $('#pendapatan').addClass('text-success');
                            }  if(data['totalUserBaru'] !== 0){
                                $('#userBaru').addClass('text-success');
                            }

                            $('tbody tr').remove();
                            if(data['detailTransaksi'].length !== 0){
                                $.each(data['detailTransaksi'], (val) => {
                                        $('tbody').append(
                                            '<tr id='+val+'>'+
                                                '<td rowspan=' + data['detailTransaksi'][val]['transaksi_items'].length+'>'+ no++ +'</td>'+
                                                '<td rowspan=' + data['detailTransaksi'][val]['transaksi_items'].length+'>'+data['detailTransaksi'][val]['id']+'</td>'+
                                                '<td rowspan=' + data['detailTransaksi'][val]['transaksi_items'].length+'>'+data['detailTransaksi'][val]['tanggal']+'</td>'+
                                                 '<td>'+data['detailTransaksi'][val]['transaksi_items'][0]['tanggal']+'</td>'+                                                
                                                '<td rowspan=' + data['detailTransaksi'][val]['transaksi_items'].length+'>'+data['detailTransaksi'][val]['nama']+'</td>'+
                                                '<td rowspan=' + data['detailTransaksi'][val]['transaksi_items'].length+'>'+data['detailTransaksi'][val]['nama_per']+'</td>'+
                                                 '<td>'+data['detailTransaksi'][val]['transaksi_items'][0]['studio']+'</td>'+
                                                '<td>'+ formatRupiah(data['detailTransaksi'][val]['transaksi_items'][0]['t_harga'], 'Rp. ') +'</td>'+   
                                                '</tr>'
                                                )

                                                for(i = 1; i < data['detailTransaksi'][val]['transaksi_items'].length; i++){
                                            $('tbody').append(
                                                '<tr>'+
                                                    '<td>'+data['detailTransaksi'][val]['transaksi_items'][0]['tanggal']+'</td>'+                                                
                                                    '<td>'+data['detailTransaksi'][val]['transaksi_items'][i]['studio']+'</td>'+
                                                    '<td>'+ formatRupiah(data['detailTransaksi'][val]['transaksi_items'][i]['t_harga'], 'Rp. ') +'</td>'+                                                    
                                                '</tr>'
                                            )
                                        }
                                    })
                            }else{
                                $('tbody').append(
                                        '<tr>'+
                                            '<td class="text-center" colspan="8">Tidak ada data</td>'+                                                
                                        '</tr>'
                                )
                            }

                                    const chart = Highcharts.chart('chart', {
                                chart: {
                                        type: 'column',
                                        scrollablePlotArea: {
                                            minWidth: 700,
                                            scrollPositionX: 1
                                        },
                                    },
                                title: {
                                    text: data['title']
                                },
                                subtitle: {
                                    text: data['subtitle']
                                },
                                xAxis: {
                                    categories: date,
                                    crosshair: true,
                                },
                                yAxis: {
                                    min: 0,
                                },
                                tooltip: {
                                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                        '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                                    footerFormat: '</table>',
                                    shared: true,
                                    useHTML: true
                                },
                                plotOptions: {
                                    column: {
                                        pointPadding: 0.2,
                                        borderWidth: 0
                                    }
                                },
                                series: [{
                                    name: 'Transaksi',
                                    data: transaksi

                                },],
                                responsive: {  
                                    rules: [{  
                                        condition: {  
                                        maxWidth: 500  
                                        },  
                                        chartOptions: {  
                                        legend: {  
                                            enabled: false  
                                        }  
                                        }  
                                    }]  
                                    },
                                });
                        }
                    })
                }

                $('.input-daterange').each( function() {
                    $(this).datepicker({
                        format: "yyyy-mm-dd",                        
                    });
                });   
                      
                    $('input#end').on('change', () => {
                       startDate = $('input[name="start"]').val()                           
                        endDate = $('input[name="end"]').val()
                     });

                     $('#tampil').on('click', ()=> {
                         start = startDate
                         end = endDate
                         let date = [];
                         let transaksi =[];
                         let no = 1;
                         
                         
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                         $.ajax({
                              url: "/manager/dashboard/report/period",
                             method: "POST",
                             data: {
                                 start : start,
                                 end: end
                             },
                              success: (data) => {
                            data = JSON.parse(data);
                            console.log(data);
                            $.each(data['data'], (val) => {
                                date = [ ...date, data['data'][val]['date']] 
                                transaksi = [ ...transaksi, data['data'][val]['transaksi']] 
                            })  

                            $('input[name="start"]').val(start)
                            $('input[name="end"]').val(end)  
                            $('input[name="id"]').val("");                          
                            $('#transaksi').text(data['totalTransaksi']);
                            $('#transaksicancel').text(data['transaksiDibatalkan']);
                            $('#user').text(data['totalUser']);
                            $('#pendapatan').text(data['totalPendapatan']);
                            $('#userBaru').text(data['totalUserBaru']);
                            $('#subtitle').text(data['subtitle']);
                            
                            if(data['totalTransaksi'] !== 0){
                                $('#transaksi').addClass('text-success');
                            }
                              if(data['transaksiDibatalkan'] !== 0){
                                $('#transaksicancel').addClass('text-danger');
                            }
                              if(data['totalPendapatan'] !== 0){
                                $('#pendapatan').addClass('text-success');
                            }  if(data['totalUserBaru'] !== 0){
                                $('#userBaru').addClass('text-success');
                            }

                                                        $('tbody tr').remove();
                            if(data['detailTransaksi'].length !== 0){
                                $.each(data['detailTransaksi'], (val) => {
                                        $('tbody').append(
                                            '<tr id='+val+'>'+
                                                '<td rowspan=' + data['detailTransaksi'][val]['transaksi_items'].length+'>'+ no++ +'</td>'+
                                                '<td rowspan=' + data['detailTransaksi'][val]['transaksi_items'].length+'>'+data['detailTransaksi'][val]['id']+'</td>'+
                                                '<td rowspan=' + data['detailTransaksi'][val]['transaksi_items'].length+'>'+data['detailTransaksi'][val]['tanggal']+'</td>'+
                                                 '<td>'+data['detailTransaksi'][val]['transaksi_items'][0]['tanggal']+'</td>'+                                                
                                                '<td rowspan=' + data['detailTransaksi'][val]['transaksi_items'].length+'>'+data['detailTransaksi'][val]['nama']+'</td>'+
                                                '<td rowspan=' + data['detailTransaksi'][val]['transaksi_items'].length+'>'+data['detailTransaksi'][val]['nama_per']+'</td>'+
                                                 '<td>'+data['detailTransaksi'][val]['transaksi_items'][0]['studio']+'</td>'+
                                                '<td>'+ formatRupiah(data['detailTransaksi'][val]['transaksi_items'][0]['t_harga'], 'Rp. ') +'</td>'+   
                                                '</tr>'
                                                )

                                                for(i = 1; i < data['detailTransaksi'][val]['transaksi_items'].length; i++){
                                            $('tbody').append(
                                                '<tr>'+
                                                    '<td>'+data['detailTransaksi'][val]['transaksi_items'][0]['tanggal']+'</td>'+                                                
                                                    '<td>'+data['detailTransaksi'][val]['transaksi_items'][i]['studio']+'</td>'+
                                                    '<td>'+ formatRupiah(data['detailTransaksi'][val]['transaksi_items'][i]['t_harga'], 'Rp. ') +'</td>'+                                                    
                                                '</tr>'
                                            )
                                        }
                                    })
                            }else{
                                $('tbody').append(
                                        '<tr>'+
                                            '<td class="text-center" colspan="8">Tidak ada data</td>'+                                                
                                        '</tr>'
                                )
                            }

                            const chart = Highcharts.chart('chart', {
                                        chart: {
                                                type: 'column',
                                                scrollablePlotArea: {
                                                    minWidth: 700,
                                                    scrollPositionX: 1
                                                }
                                                },
                                            title: {
                                                text: data['title']
                                            },
                                            subtitle: {
                                                text: data['subtitle']
                                            },
                                            xAxis: {
                                                categories: date,
                                                crosshair: true,
                                            },
                                            yAxis: {
                                                min: 0,
                                            },
                                            tooltip: {
                                                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                                                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                                                footerFormat: '</table>',
                                                shared: true,
                                                useHTML: true
                                            },
                                            plotOptions: {
                                                column: {
                                                    pointPadding: 0.2,
                                                    borderWidth: 0
                                                }
                                            },
                                            series: [{
                                                name: 'Transaksi',
                                                data: transaksi

                                            },],
                                            responsive: {  
                                                rules: [{  
                                                    condition: {  
                                                    maxWidth: 500  
                                                    },  
                                                    chartOptions: {  
                                                    legend: {  
                                                        enabled: false  
                                                    }  
                                                    }  
                                                }]  
                                                }
                                        });
                        }
                         })
                     })

                     getReport(period);

                     $('select#period').on('change', ()=> {
                        period = $('select#period').val()
                        $('#chart').remove()
                        getReport(period);
                     })
            })
        </script>
@endsection