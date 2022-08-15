@extends('assets.master_assets')

        @section('breadcrumb-page')
            <li class="breadcrumb-item active" aria-current="page">Bot Testing</li>
        @endsection

        @section('title-page')
            <h1 class="mb-0 fw-bold">Bot Testing</h1> 
        @endsection

        @section('content')
        <div class="row d-flex justify-content-center mt-3">
            <div class="col-md-12 col-lg-12 col-sm-12">
                                {{-- list data pertanyaan --}}
                 <div class="row">
                    <div class="card card-body shadow col-12">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle border rounded caption-top table-data">
                                <caption>List data pertanyaan</caption>
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            Label
                                        </th>
                                        <th class="text-center">
                                            Text
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                     <tr>
                                        <td class="text-center">
                                            {{$data['class']}}
                                        </td>
                                        <td class="text-center">
                                            {{$data['text']}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- end list data pertanyaan --}}
                {{-- Jumlah data dari setiap label pertanyaan --}}
                <div class="row">
                    <div class="card card-body shadow col-12">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle border rounded caption-top">
                                <caption>Jumlah data dari setiap label pertanyaan</caption>
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            Label
                                        </th>
                                        <th class="text-center">
                                            Jumlah data
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{dd($allClassData)}} --}}
                                    @php
                                        $i = 0;
                                        $jumlah = 0;
                                    @endphp
                                    @foreach ($res as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{$item['class']}}
                                        </td>
                                        <td class="text-center">{{count($allClassData[$i])}}</td>
                                    </tr>
                                    @php
                                    $jumlah += count($allClassData[$i++]);    
                                    @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">
                                            {{$jumlah}}
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- end --}}
                <div class="row">
                    <div class="card card-body shadow col-12">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle border rounded caption-top">
                                <caption>Menghitung berapa kali setiap kata muncul di label tersebut</caption>
                                @php
                                 $i = 0;   
                                @endphp
                                <thead>
                                    <tr>
                                        <th></th>
                                        @foreach ($res[0]['words'] as $item)
                                        <th class="text-center">
                                            {{$item['word']}}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($res as $class)
                                     <tr>
                                        <td rowspan="2" class="text-center">
                                            {{$class['class']}}
                                        </td>
                                        @foreach ($class['words'] as $word)
                                            <td  class="text-center">{{$word['count']}}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($class['computed'] as $word)
                                            <td  class="text-center">{{$word['value']}} </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="card card-body shadow col-12">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle border rounded caption-top">
                                <caption>Membagi berapa kali setiap kata muncul di label tersebut dengan jumlah data</caption>
                                @php
                                 $i = 0;   
                                @endphp
                                <tbody>
                                    @foreach ($res as $class)
                                     <tr>
                                        <td class="text-center">
                                            {{$class['class']}}
                                        </td>                                        
                                        <td class="text-center">{{count($allClassData[$i++]) . ' / '. $jumlah}}</td>
                                        <td class="text-center">
                                            {{$class['pData']}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card card-body shadow col-12">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle border rounded caption-top">
                                <caption>menghitung jumlah kata yang sering muncul di label tersebut</caption>
                                @php
                                 $i = 0;   
                                @endphp
                                <tbody>
                                    @foreach ($res as $class)
                                     <tr>
                                        <td class="text-center">
                                            {{$class['class']}}
                                        </td>                                        
                                        <td class="text-center">{{$wordsCount[0][$i++]}}</td>
                                        {{-- <td class="text-center">
                                            {{$class['pData']}}
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="card card-body shadow col-12">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle border rounded caption-top">
                                <caption>Jumlah kata yang sering muncul ditambah 1, di bagi dengan total kata + total kata pada label tersebut</caption>
                                @php
                                 $i = 0;   
                                @endphp
                                <thead>
                                    <tr>
                                        <th></th>
                                        @foreach ($res[0]['words'] as $item)
                                        <th class="text-center">
                                            {{$item['word']}}
                                        </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($res as $class)
                                     <tr>
                                        <td rowspan="2" class="text-center">
                                            {{$class['class']}}
                                        </td>
                                        @foreach ($class['words'] as $word)
                                            <td  class="text-center">{{'('. $word['count'] .' + '. 1 .' = '. $word['count']+1 .') / ('. count($words) .' + '. $wordsCount[0][$i] . ')'   }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($class['computed'] as $word)
                                            <td  class="text-center">{{$word['value']}} </td>
                                        @endforeach
                                    </tr>
                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card card-body shadow col-12">
                        <form action="">
                            <div class="col-auto">
                                <textarea name="input" class="form-control mb-3" id="" cols="3" rows="3"></textarea>
                            </div>
                            <div class="col-auto text-end">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                  <div class="row">
                    <div class="card card-body shadow col-12">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle border rounded caption-top">
                                <caption>Nilai setiap kata pada doucument uji</caption>
                                {{-- {{dd($testClass)}} --}}
                                @php
                                 $i = 0;   
                                @endphp
                                <thead>
                                    <tr>
                                        <th></th>
                                    @foreach ($match as $key => $value)                                    
                                    @foreach ($value as $key => $val)                                    
                                        <th class="text-center">
                                            {{$val['word']}}
                                        </th>
                                        @endforeach
                                        @endforeach
                                </tbody>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testClass as $key => $value)
                                    <tr>
                                        <th class="text-center">
                                            {{$key}}
                                        </th>
                                        @foreach ($value['computed'] as $key => $value)
                                        <td>{{$value}}</td>
                                        @endforeach
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card card-body shadow col-12">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle border rounded caption-top">
                                <caption>Kalikan setiap nilai kata per label</caption>
                                {{-- {{dd($testClass)}} --}}
                                {{-- {{dd($result)}} --}}
                               
                                <thead>
                                    <tr>
                                        <th class="text-center">Label</th>
                                        <th class="text-center">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testClass as $key => $value)
                                @php
                                 $i = 0;
                                 $jum = 1;
                                @endphp
                                    <tr>
                                        <th class="text-center">
                                            {{$key}}
                                        </th>
                                        <td>
                                        @foreach ($value['computed'] as $key => $value)
                                            @php
                                            $jum *= $value
                                            @endphp
                                            @endforeach
                                            {{$jum}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card card-body shadow col-12">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle border rounded caption-top">
                                <caption>Hasil klasifikasi dengan mengambil nilai yang paling tinggi</caption>
                                <thead>
                                    <tr>
                                        <th class="text-center">Label</th>
                                        <th class="text-center">Nilai</th>
                                    </tr>
                                </thead>
                                @php
                                 $max = max($result);
                                @endphp
                                <tbody>
                                    @foreach ($testClass as $key => $value)
                                    @if ($value['result'] === $max)
                                    <tr>
                                        <th class="text-center">
                                            {{$key}}
                                        </th>
                                        <td class="text-center">
                                            {{$max}}
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script>
        $('document').ready(() => {
            let label = [];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
            $.ajax({
                url: "/nbc/training",
                method:"GET",
                success : (data)=>{
                    data = JSON.parse(data);
                    label = data['class'];

                }
            })
            // Highcharts.chart('container', {
            //     chart: {
            //         type: 'bar'
            //     },
            //     title: {
            //         text: 'Historic World Population by Region'
            //     },
            //     subtitle: {
            //         text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'
            //     },
            //     xAxis: {
            //         categories: ['Africa', 'America', 'Asia', 'Europe', 'Oceania'],
            //         title: {
            //             text: null
            //         }
            //     },
            //     yAxis: {
            //         min: 0,
            //         title: {
            //             text: 'Population (millions)',
            //             align: 'high'
            //         },
            //         labels: {
            //             overflow: 'justify'
            //         }
            //     },
            //     tooltip: {
            //         valueSuffix: ' millions'
            //     },
            //     plotOptions: {
            //         bar: {
            //             dataLabels: {
            //                 enabled: true
            //             }
            //         }
            //     },
            //     legend: {
            //         layout: 'vertical',
            //         align: 'right',
            //         verticalAlign: 'top',
            //         x: -40,
            //         y: 80,
            //         floating: true,
            //         borderWidth: 1,
            //         backgroundColor:
            //             Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
            //         shadow: true
            //     },
            //     credits: {
            //         enabled: false
            //     },
            //     series: [{
            //         name: 'Year 1800',
            //         data: [107, 31, 635, 203, 2]
            //     }, {
            //         name: 'Year 1900',
            //         data: [133, 156, 947, 408, 6]
            //     }, {
            //         name: 'Year 2000',
            //         data: [814, 841, 3714, 727, 31]
            //     }, {
            //         name: 'Year 2016',
            //         data: [1216, 1001, 4436, 738, 40]
            //     }]
            // });
        })
    </script>
        @endsection