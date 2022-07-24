

@if ($errors->any() )
        <div class="row mb-3 fixed-bottom d-flex justify-content-end" id="alert-wrapper">
            <div class="col-4">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>
                        <strong>{{$error}}</strong>
                        </li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <script>
            const alert = document.getElementById('alert-wrapper')
            setTimeout(hideElement, 5000) //milliseconds until timeout//
            function hideElement() {
                alert.remove()
            }
        </script>
@endif


@if ($message = Session::get('success'))
        <div class="row mb-3 fixed-bottom d-flex justify-content-end" id="alert-wrapper">
            <div class="col-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{$message}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <script>
            const alert = document.getElementById('alert-wrapper')
            setTimeout(hideElement, 5000) //milliseconds until timeout//
            function hideElement() {
                alert.remove()
            }
        </script>
@endif