@extends('admin.master_admin')


@section('breadcrumb-page')
    <li class="breadcrumb-item active" aria-current="page">Profile</li>
@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold">Profile</h1> 
@endsection
       
@section('content')
        <style>
    .dropzone-wrapper {
  border: 2px dashed #91b0b3;
  color: #92b0b3;
  position: relative;
  height: 150px;
}
.dropzone-desc {
  position: absolute;
  margin: 0 auto;
  left: 0;
  right: 0;
  text-align: center;
  width: 40%;
  top: 50px;
  font-size: 16px;
}
.dropzone,
.dropzone-edit,
.dropzone:focus,
.dropzone-edit:focus {
  position: absolute;
  outline: none !important;
  width: 100%;
  height: 150px;
  cursor: pointer;
  opacity: 0;
}

.dropzone-wrapper:hover,
.dropzone-wrapper.dragover {
  background: #ecf0f5;
}
</style>
        <div class="row mb-5 mt-5" style="min-height: 70vh">
            <div class="col-12">
                @include('alert.alert')
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12 ">
                            <div class="row mb-3 mb-5 mt-5">
                                <div class="col-12 text-center">
                                    @if ($user->img != null)
                                    <img src="{{asset('assets/images/profile/admin/'.$user->img)}}" class="rounded-circle border" alt="" srcset="" style="width :150px ;height:150px">
                                    @else                                        
                                    <img src="{{asset('assets/images/profile/default-person.jpg')}}" class="rounded-circle" alt="" srcset="" style="width :150px ">
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-grid gap-2 mx-auto col-6">
                                    <button class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#updateImages" >Ubah</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 mt-5 mb-5">
                            <form action="{{route('update.profile.admin', $user->id)}}" method="post">
                                @csrf
                                <div class="row mb-3 me-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="" class="label-form">Nama</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <input type="text" value="{{old('name', $user->name)}}" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="row mb-3 me-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="" class="label-form">Email</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <input type="text" value="{{old('email', $user->email)}}" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="row mb-3 me-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="" class="label-form">No Hp</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <input type="text" value="{{old('no_hp', $user->no_hp)}}" class="form-control" name="no_hp">
                                    </div>
                                </div>
                                <div class="row mb-5 me-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label for="" class="label-form">Password</label>
                                    </div>
                                    <div class="col-lg-6  col-md-6 col-sm-12">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#changePassword" >Ubah Password</button>
                                    </div>
                                </div>
                                <div class="row mb-3 me-3 mt-3">
                                    <div class="d-grid gap-2 col-4 mx-auto">
                                        <button class="btn btn-danger"> Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>

    <div class="modal fade" id="updateImages" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-center">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Updates Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('update.images.admin', $user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3 d-flex justify-content-center">
                           <div class="col-10">
                            <div class="row mb-3">
                            <div class="images-preview-div-edit text-center"> </div>
                        </div>
                            <div class="row mb-3">
                                <div class="dropzone-wrapper">
                                    <div class="dropzone-desc">
                                        <i class="bx bx-download"></i>
                                        <p>Choose an image file or drag it here.</p>
                                    </div>
                                    <input type="file" name="images" type="image" class="dropzone-edit">
                                </div>
                            </div>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveImages">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-center">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('update.password.admin', $user->id)}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3 d-flex justify-content-center">
                           <div class="col-10">
                            <div class="row mb-3">
                                <label for="" class="form-label">Password Lama</label>
                                <input type="password" class="form-control" name="oldPassword">
                            </div>
                            <div class="row mb-3">
                                <label for="" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" name="password">
                            </div><div class="row mb-3">
                                <label for="" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                           </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveImages">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script >
$(function() {
// Multiple images preview with JavaScript
var previewImages = function(input, imgPreviewPlaceholder) {
if (input.files) {
var filesAmount = input.files.length;
if(filesAmount <= 5){
    for (i = 0; i < filesAmount; i++) {
    var reader = new FileReader();
    reader.onload = function(event) {
    $($.parseHTML('<img class="img-preview d-block w-100 mb-3">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
    }
    reader.readAsDataURL(input.files[i]);
    }
} else{
    $($.parseHTML(
            '<div class="row mb-3 fixed-bottom d-flex justify-content-end" id="alert-wrapper">'+
            '<div class="col-4">'+
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                    '<strong>Max 5 file</strong>'+
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'+
                '</div>'+
            '</div>'+
        '</div>'
    )).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);  
     const alert = document.getElementById('alert-wrapper')
            setTimeout(hideElement, 5000) //milliseconds until timeout//
            function hideElement() {
                alert.remove()
            }  

    $('#saveImages').addClass('disabled')
    $('.img-preview').remove()
    $('.droppzone').value(null)
}
}
};
$('.dropzone').on('change', function() {
        $('.img-preview').remove()
previewImages(this, 'div.images-preview-div');
});
$('.dropzone-edit').on('change', function() {
        $('.img-preview').remove()
previewImages(this, 'div.images-preview-div-edit');
});
});
</script>
@endsection