

@extends('assets.master_assets')
       
@section('content')
<div class="container-fluid mt-5">
    <div class="row mb-3">
        <div class="col-lg-12 col-md-12 col-sm-12" id="form_pembayaran">
                <div class="container-fluid mt-3 mb-3">
                  <div class="row mb-3">
                    <h6>Nama : {{$user->name}}</h6>
                    <h6>Email : {{$user->email}}</h6>
                    <h6>No Telephone : {{$user->no_hp}}</h6>
                  </div>
                  <hr>
                  <div class="row mb-3">
                    <div class="col-12">
                       <form>
                            <div class="row mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Perusahaan</label>
                                <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan">
                            </div>
                            <div class="row mb-3">
                                <label for="exampleInputPassword1" class="form-label">Email Perusahaan</label>
                                <input type="email" class="form-control" name="email_perusahaan">
                            </div>
                            <div class="row mb-3">
                                <label for="exampleInputPassword1" class="form-label">No Telephone Perusahaan</label>
                                <input type="text" class="form-control" name="no_perusahaan">
                            </div>
                            <div class="row mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Tanggal Booking</label>
                                    <input type="date" name="tanggal" class="form-control" id="tanggal">
                            </div>
                            <div class="row">
                                <div class="input-group mb-3">
                                    <span for="" class="input-group-text">Durasi Shooting</span>
                                    <input type="number" name="durasi_shooting" class="form-control" value="12" min="12" step="1">
                                    <span class="input-group-text" id="basic-addon2">Jam</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-10 ms-3">
                                    <input class="form-check-input" name="check" type="checkbox" value="true" id="check">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Apakah perlu setting alat di luar jam shooting ?
                                    </label>
                                </div>
                            </div>
                            <div class="row d-none" id="durasi_setting_wrapper">
                                <div class="input-group mb-5">
                                    <span for="" class="input-group-text">Durasi Setting</span>
                                     <input type="number" name="durasi_setting" class="form-control" value="12" min="12" step="1">
                                     <span class="input-group-text" id="basic-addon2">Jam</span>
                                 </div>
                            </div>
                            <div class="row mb-3">
                                <div class=" d-grid gap-2 col-6 mx-auto">
                                    <button type="button" class="btn btn-danger " id="btn-hitung">Booking Sekarang</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 d-none" id="order-summary">
            <div class="card card-body">
                <div class="container-fluid mt-3 mb-3">
                    <div class="row">
                        <div class="col-6">
                            <h6>Nama :</h6>
                            <h6>Email : </h6>
                            <h6>No Telephone :</h6>
                            <h6>Nama Perusahaan : </h6>
                            <h6>Email Perusahaan :</h6>
                            <h6>No Telephone Perusahaan :</h6>
                            <h6>Harga Shooting : </h6>
                            <p>Durasi : </p>                        
                            <h6>Harga Setting : </h6>
                            <p>Durasi : </p>
                            <h6>Tanggal : </h6>
                        </div>
                        <div class="col-6">
                            <h6 id="nama">{{$user->nama}}</h6>
                            <h6 id="email">{{$user->email}}</h6>
                            <h6 id="no_tel">{{$user->no_hp}}</h6>
                            <h6 id="nama_per"></h6>
                            <h6 id="email_per"></h6>
                            <h6 id="no_tel_per"></h6>
                           <h6 id="shooting" > </h6>
                            <p id="dur_shooting" >  </p>                        
                            <h6 id="setting" > </h6>
                            <p id="dur_set" > </p>
                            <h6 id="tanggall" >  </h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-6">
                            <h6>Total : </h6>
                            <h6>DP 20% : </h6>
                        </div>
                        <div class="col-6">
                            <h6 id="total" >  </h6>
                            <h6 id="dp" > </h6>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-danger">Bayar Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('doucument').ready(()=> {
        let email_perusahaan
        let no_perusahaan
        let nama_perusahaan
        let tanggal
        let durasi_setting = 0
        let durasi_shooting = 0

        $('input[name="durasi_setting"]').val(0)
        $('#check').on('change', ()=> {
            val = $('#check:checked').val()
            console.log(val)
            if(val == "true"){
                $('#durasi_setting_wrapper').removeClass('d-none');
                 $('input[name="durasi_setting"]').val(12)
            } else {
                 $('input[name="durasi_setting"]').val(0)
                $('#durasi_setting_wrapper').addClass('d-none');
            }
        })

        $('#btn-hitung').on('click', ()=> {
            harga_shooting = {{$studio->harga_shooting}}
            harga_setting = {{$studio->harga_setting}}
            overcharge_shooting = {{$studio->overcharge_shooting}}
            overcharge_setting = {{$studio->overcharge_setting}}

            email_perusahaan = $('input[name="email_perusahaan"]').val()
            nama_perusahaan = $('input[name="nama_perusahaan"]').val()
            no_perusahaan = $('input[name="no_perusahaan"]').val()
            tanggal = $('#tanggal').val()
            durasi_shooting = $('input[name="durasi_shooting"]').val()
            durasi_setting = $('input[name="durasi_setting"]').val()

            console.log(
            email_perusahaan + ', '+
            no_perusahaan + ', '+
            nama_perusahaan + ', '+
            tanggal + ', '+
            durasi_setting + ', '+
            durasi_shooting 
            )

            sisa_bagi = durasi_shooting % 12;
            $('#dur_shooting').text(durasi_shooting)
           durasi_shooting = Math.floor(durasi_shooting/12);
           harga_shooting = durasi_shooting * harga_shooting;
           if(sisa_bagi > 0){
            harga_shooting = harga_shooting + (sisa_bagi * overcharge_shooting)
           }

            sisa_bagi = durasi_setting % 12;
            $('#dur_set').text(durasi_setting)
           durasi_setting = Math.floor(durasi_setting/12);
           harga_setting = durasi_setting * harga_setting;
           if(sisa_bagi > 0){
            harga_setting = harga_setting + (sisa_bagi * overcharge_setting)
           }

                $('#nama_per').text(nama_perusahaan)
                $('#email_per').text(email_perusahaan)
                $('#no_tel_per').text(no_perusahaan)
                $('#shooting').text(formatRupiah(harga_shooting,"Rp"))
                $('#setting').text(formatRupiah(harga_setting,"Rp"))
                $('#tanggal').text(tanggal)

                total = harga_shooting + harga_setting
                $('#total').text(formatRupiah(total,  "Rp"))
                dp = (20 / 100) * total
                $('#dp').text(formatRupiah(dp,"Rp"))

                $('#form_pembayaran').addClass('d-none')
                $('#order-summary').removeClass('d-none')
                
        })
    })
</script>
@endsection