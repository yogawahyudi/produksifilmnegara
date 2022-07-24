@extends('assets.master_assets')

@section('breadcrumb-page')
    <li class="breadcrumb-item">Studio</li>
    <li class="breadcrumb-item active" aria-current="page">{{$studio->studio}}</li>

@endsection

@section('title-page')
    <h1 class="mb-0 fw-bold"> Images {{$studio->studio}}</h1> 
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
    <div class="container-fluid">
        @include('alert.alert')
        <div class="row mb-3">
            <div class="col-6">
                <button class="btn btn-primary" 
                @if ($imagesStudio->count() >= 5)
                disabled
                @endif
                data-bs-toggle="modal" data-bs-target="#createStudioImages"><i class="bx bx-plus"></i>Images Studio</button>
            </div>
        </div>

        @foreach ($imagesStudio as $is)      
        <div class="row mb-3">
            <div class="col-12">
                <div class="card card-body">
                    <div class="container-fluid">
                        <div class="row d-flex align-items-center">
                            <div class="col-8">
                                <img src="{{asset('assets/images/studio/'.$is->img)}}" class="d-block w-100 rounded" alt="" srcset="">
                            </div>
                            <div class="col-4">
                                <div class="row mb-5">
                                    <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editImages{{$is->id}}"><i class="bx bx-reset bx-fw"></i></button>
                                        <form action="{{route('delete.imageStudio', $is->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="bx bx-trash bx-fw"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>

    <div class="modal fade" id="createStudioImages" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-center">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Studio Images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('store.image.studio', $studio->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-3 d-flex justify-content-center">
                           <div class="col-10">
                            <div class="row mb-3">
                                <div class="images-preview-div text-center"> </div>
                            </div>
                                <div class="row mb-3">
                                    <div class="dropzone-wrapper">
                                        <div class="dropzone-desc">
                                            <i class="bx bx-download"></i>
                                            <p>Choose an image file or drag it here.</p>
                                        </div>
                                        <input type="file" name="images[]" type="image" class="dropzone" multiple>
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

    
@foreach ($imagesStudio as $is)    
<div class="modal fade" id="editImages{{$is->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-center">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Images</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('update.imageStudio', $is->id)}}" method="post" enctype="multipart/form-data">
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
@endforeach


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