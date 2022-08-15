<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
       table {
        width: 100%;
       }

       td{
        padding-bottom: 10px
       }

       table.minimalistBlack {
        border: 1px solid #eee;
        width: 100%;
        border-radius: 10px;
        text-align: center;
        border-collapse: collapse;
      }
      table.minimalistBlack td, table.minimalistBlack th {
        border: 1px solid #000000;
        padding: 5px 4px;
      }
      table.minimalistBlack tbody td {
        font-size: 13px;
      }
      table.minimalistBlack thead {
        background: #CFCFCF;
        background: -moz-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
        background: -webkit-linear-gradient(top, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
        background: linear-gradient(to bottom, #dbdbdb 0%, #d3d3d3 66%, #CFCFCF 100%);
        border-bottom: 3px solid #000000;
      }
      table.minimalistBlack thead th {
        font-size: 15px;
        font-weight: bold;
        color: #000000;
        text-align: center;
      }
      table.minimalistBlack tfoot {
        font-size: 14px;
        font-weight: bold;
        color: #000000;
        border-top: 3px solid #000000;
      }
      table.minimalistBlack tfoot td {
        font-size: 14px;
      }
    </style>
</head>
<body>
    <table>
        <tbody>
            <tr>
              <td>
                <table  style="border-bottom: 3px solid black; border-radius: 10px">
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <td rowspan="2" align="center"><img src="{{asset('assets/images/logo-pfn.png')}}" alt="Logo PFN" height="100" width="100"></td>
                            <td style="padding-bottom: 0;">Perum Produksi Film Negara</td>
                        </tr>
                        <tr>
                            <td>
                                Jl. Otista Raya No.125-127, RT.9/RW.8,<br> Bidara Cina, Kecamatan Jatinegara, Kota Jakarta Timur,<br> Daerah Khusus Ibukota Jakarta  13330
                            </td>
                        </tr>
                    </tbody>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table>
                    <thead>
                        <tr>
                            <td>Bill To : </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Nama : {{$mailData['transaksi']['nama']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email : {{$mailData['transaksi']['email']}}</td>
                                        </tr>
                                        <tr>
                                            <td>No Handphone : {{$mailData['transaksi']['no_hp']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Nama Perusahaan : {{$mailData['transaksi']['nama_per']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email Perusahaan : {{$mailData['transaksi']['email_per']}}</td>
                                        </tr>
                                        <tr>
                                            <td>No Handphone Perusahaan : {{$mailData['transaksi']['no_hp_per']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table>
                    <tr>
                      <td>
                        Transaksi id : {{$mailData['idTransaksi']}}
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Tanggal : {{$mailData['tanggal']}}
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Rincian Pesanan
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <table class="minimalistBlack">
                          <tr>
                            <th align="center" class="purchase_heading">
                              {{-- <p class="f-fallback">Rincian Pesanan</p> --}}
                              Studio
                            </th>
                            <th align="center" class="purchase_heading">
                              {{-- <p class="f-fallback">Rincian Pesanan</p> --}}
                              Tanggal
                            </th>
                            <th align="center" class="purchase_heading">
                              {{-- <p class="f-fallback">Rincian Pesanan</p> --}}
                              Deskripsi
                            </th>
                            <th align="center" class="purchase_heading">
                              {{-- <p class="f-fallback">Rincian Pesanan</p> --}}
                              Biaya
                            </th>
                            {{-- <th class="purchase_heading"">
                              <p class="f-fallback">Amount</p>
                            </th> --}}
                          </tr>
                          {{-- {{#each invoice_details}} --}}
                          <tr>
                            <td rowspan="2" class="purchase_item" align="center"><span class="f-fallback">{{$mailData['transaksi_items'][0]->studio}}</span></td>
                            <td rowspan="2" class="purchase_item" align="center"><span class="f-fallback">{{$mailData['transaksi_items'][0]->tanggal}}</span></td>                                
                            <td class="purchase_item" width="25%" align="center"><span class="f-fallback">
                              Shooting :  {{($mailData['transaksi_items'][0]->durasi_shooting - ($mailData['transaksi_items'][0]->durasi_shooting % 12)) / 12 }} (per 12 jam) <br>
                              overcharge Shooting :  {{$mailData['transaksi_items'][0]->durasi_shooting % 12 }} Jam <br>                                    
                            </span></td>
                            <td class="purchase_item" align="center"><span class="f-fallback">
                                Rp. {{number_format($mailData['transaksi_items'][0]->harga_shooting ,2,',','.')}} <br>
                                Rp. {{number_format($mailData['transaksi_items'][0]->overcharge_shooting ,2,',','.')}}
                            </span></td>
                          </tr>
                          <tr>
                            <td class="purchase_item" width="25%" align="center"><span class="f-fallback">
                              Setting : {{ ($mailData['transaksi_items'][0]->durasi_setting - ($mailData['transaksi_items'][0]->durasi_setting % 12)) / 12 }} (per 12 jam) <br>
                              overcharge Setting : {{$mailData['transaksi_items'][0]->durasi_setting / 12}} Jam                                    
                            </span></td>
                              <td class="purchase_item" align="center"><span class="f-fallback">
                                Rp. {{number_format($mailData['transaksi_items'][0]->harga_setting ,2,',','.')}} <br>
                                Rp. {{number_format($mailData['transaksi_items'][0]->overcharge_setting ,2,',','.')}}
                              </span></td>
                          </tr>
                          {{-- {{/each}} --}}
                          <tr>
                            <td colspan="3" class="purchase_footer">
                              <p align="center" class="f-fallback purchase_total purchase_total--label">Total</p>
                            </td>
                            <td class="purchase_footer">
                              <p align="center" class="f-fallback purchase_total">Rp. {{number_format($mailData['transaksi_items'][0]->t_harga,2,',','.')}}</p>
                            </td>
                          </tr>
                          @if (count($mailData['transaksi_items']) > 1){
                              <tr>
                                  <td colspan="4">Additional</td>
                              </tr>
                          <tr>
                            <td rowspan="2" class="purchase_item" align="center"><span class="f-fallback">{{$mailData['transaksi_items'][1]->studio}}</span></td>
                            <td rowspan="2" class="purchase_item" align="center"><span class="f-fallback">{{$mailData['transaksi_items'][1]->tanggal}}</span></td>                                
                            <td class="purchase_item" width="25%" align="center"><span class="f-fallback">
                              Shooting :  {{($mailData['transaksi_items'][1]->durasi_shooting - ($mailData['transaksi_items'][1]->durasi_shooting % 12)) / 12 }} (per 12 jam) <br>
                              overcharge Shooting :  {{$mailData['transaksi_items'][1]->durasi_shooting % 12 }} Jam <br>                                    
                            </span></td>
                            <td class="purchase_item" align="center"><span class="f-fallback">
                                Rp. {{number_format($mailData['transaksi_items'][1]->harga_shooting ,2,',','.')}} <br>
                                Rp. {{number_format($mailData['transaksi_items'][1]->overcharge_shooting ,2,',','.')}}
                            </span></td>
                          </tr>
                          <tr>
                            <td class="purchase_item" width="25%" align="center"><span class="f-fallback">
                              Setting : {{ ($mailData['transaksi_items'][1]->durasi_setting - ($mailData['transaksi_items'][1]->durasi_setting % 12)) / 12 }} (per 12 jam) <br>
                              overcharge Setting : {{$mailData['transaksi_items'][1]->durasi_setting / 12}} Jam                                    
                            </span></td>
                              <td class="purchase_item" align="center"><span class="f-fallback">
                                Rp. {{number_format($mailData['transaksi_items'][1]->harga_setting ,2,',','.')}} <br>
                                Rp. {{number_format($mailData['transaksi_items'][1]->overcharge_setting ,2,',','.')}}
                              </span></td>
                          </tr>
                          {{-- {{/each}} --}}
                          <tr>
                            <td colspan="3" class="purchase_footer">
                              <p align="center" class="f-fallback purchase_total purchase_total--label">Total</p>
                            </td>
                            <td class="purchase_footer">
                              <p align="center" class="f-fallback purchase_total">Rp. {{number_format($mailData['transaksi_items'][1]->t_harga,2,',','.')}}</p>
                            </td>
                          </tr>
                          }
                              
                          @else
                              
                          @endif
                          {{-- <tr>
                            <td colspan="3" class="purchase_footer">
                              <p align="left" class="f-fallback purchase_total purchase_total--label">Yang harus dibayarkan</p>
                            </td>
                            <td class="purchase_footer">
                              <p align="left" class="f-fallback purchase_total">DP (20%) Rp. {{number_format($mailData['tagihan']['nominal'],2,',','.')}}</p>
                            </td>
                          </tr> --}}
                        </table>
                      </td>
                    </tr>
                </table>
              </td>
            </tr>     
          </tbody>
        </table>
</body>
</html>