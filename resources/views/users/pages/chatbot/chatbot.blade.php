       @extends('users.master_user')
       
        @section('content')
        <div class="row d-flex justify-content-center mt-3">
            <div class="col-md-10 col-lg-10 col-sm-12">
                <div class="card">
                    <div class="card-body" style="background-color: #f8f9fa;">
                        <div class="row">
                            <div class="col-12" style="height: calc(100vh - 200px); overflow:hidden">
                                <div class="message-container" id="buble" style="height: 100%; overflow-y:scroll; overflow-x:hidden; margin-right: -50px;">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex border-top" id="inputrow">
                            <div class="col-12">
                                <div class="input-group mt-3">
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="input" placeholder="Type Your Message">
                                    <button class="btn btn-outline-primary" type="button" id="send"><i class='bx bxs-send'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <script>
  $('document').ready(() => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });

            $('#buble').append(
                '<div class="row mb-1 d-flex justify-content-start" id="botBuble">' +
                '<div class="col-10  d-flex justify-content-start">' +
                '<div class="card" style="width: auto">' +
                '<div class="card-body" style="background-color: #eee">' +
                '<p class="mb-0 mt-0" id="text">Hallo selamat datang ada yang bisa dibantu</p>'  +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>'
            )

            $('#send').on('click', () => {
                send()
            })

            $('input[name="input"]').on('keypress', (e) => {
                if (e.which == 13) {
                    send()
                }
            })


            const send = () => {
                input = $('input[name="input"]').val()
                $('input[name="input"]').val("")
                $('#buble').append(
                    '<div class="row mb-1 d-flex justify-content-end"" id="userBuble" >' +
                    '<div class="col-10 d-flex justify-content-end" style="padding-right:48px">' +
                    '<div class="card style="width: auto">' +
                    '<div class="card-body">' +
                    '<p class="mb-0 mt-0" id="text">'++'</p>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                )


                if (input != "") {
                   $.ajax({
                    url: "/chatbot/listen",
                    method: "POST",
                    data: {
                        input: input
                    },
                    success: (data) => {
                        console.log(data)
                        if(typeof data === 'object' && data !== null){
                            $('#buble').append(
                                '<div class="row mb-1 d-flex justify-content-start" id="botBuble">' +
                                '<div class="col-10  d-flex justify-content-start">' +
                                '<div class="card" style="width: auto">' +
                                '<div class="card-body" style="background-color: #eee">' +
                                '<p id="text"> Pattern found : pattern = ' +data['pattern']+ '</p>' +                                                            
                                '<p id="text"> Pattern found at index : ' +data['index']+ '</p>' +
                                '<p id="text"> Respon dari bot : ' +data['respon']+ '</p>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                            )
                        } else {
                                $('#buble').append(
                                '<div class="row mb-1 d-flex justify-content-start" id="botBuble">' +
                                '<div class="col-10  d-flex justify-content-start">' +
                                '<div class="card" style="width: auto">' +
                                '<div class="card-body" style="background-color: #eee">' +
                                '<p id="text"> Respon dari bot : ' +data+ '</p>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                            )
                        }
                        messageContainer = $('.message-container')
                        messageContainer.scrollTop(messageContainer.height())

                    },
                    error: (data)=>{
                        console.log(data);
                    }
                })
                }
            }
        })
    </script>
        @endsection