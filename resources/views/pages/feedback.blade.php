@extends('layouts.basicLayout')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/feedback.css') }}" >
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <h1 class="" style="font-weight: bold; margin-bottom: 0;">Feedback</h1>
                <span class="text-muted greyout" style="margin-top: 0;">Get in touch</span>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card ">
                    <div class="card-body">
                        <div class="row" style="padding-left: 3%;">
                            <img src="{{ URL::asset('/images/rr-logo.svg') }}" alt="rr-logo" height="35%" width="35%">
                            <img src="{{ URL::asset('/images/help-icon.png') }}" class="justify-content-right greyout" 
                                style="margin-right:3%; margin-left: auto; cursor: help;" alt="help-icon" height="20px" width="20px"
                                id="helpIcon"
                                >
                        </div>
                        <form action="{{route('feedback')}}" method="POST" name="feedback_form" id="feedback_form">
                            @csrf
                            <div class="row" style="padding-left: 3%;">
                                <span class="required" style="font-weight: bold;">Work Remotely. Better.</span>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="nameInput" style="font-weight: bold;">Name <span class="required" style="">*</span></label>
                                <input required type="text" class="form-control" id="nameInput" name="name" placeholder="Enter Name" value="{{old('name')}}" minlength="2" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="emailInput" style="font-weight: bold;">E-mail Address <span class="required" style="">*</span></label>
                                <input required type="email" class="form-control" id="emailInput" name="email" placeholder="Enter E-mail" value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <label for="commentInput" style="font-weight: bold;">Questions / Comments <span class="required" style="">*</span></label>
                                <textarea required class="form-control" id="commentInput" name="comments" placeholder="Enter Questions/Comments" rows="4" onkeyup="changeCounter()" minlength="6" maxlength="200" >{{old('comments')}}</textarea>
                                <small id="counter" class="form-text text-right" style="color: #6c757d"><span id="count-input">0</span>/200</small>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-center" style="padding-bottom: 10px;">
                                    <button type="submit" class="btn btn-secondary btn-lg borderless" style="background-color: #ea5d24 !important;">Submit</button>
                                </div>
                                <div class="col-md-6 text-center">
                                    <button id="resetbutton" type="button" class="btn btn-outline-secondary btn-lg borderless"><u>Reset</u></button>
                                </div>
                            </div>
                        </form>
                        <br>
                    </div>
                </div>  
            </div>
        </div>
    </div>

    <script>
        function changeCounter(){
            count = $('#commentInput').val().length;
            $('#count-input').html(count);
            if(count > 199)
                $('#counter').css('color','red');
            else
                $('#counter').css('color','#6c757d');
        }

        $('#resetbutton').click( function (){
            Swal.fire({
                title: 'Do you want to reset the fields?',
                icon: 'warning',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Reset`,
                denyButtonText: `Don't reset`,
                }).then((result) => {

                if (result.isConfirmed) {
                    fields = ['nameInput', "emailInput", "commentInput"];
                    for(i = 0; i < 3; i++){
                        $('#'+fields[i]).val('')
                    }
                    changeCounter();

                    Swal.fire('Reset!', '', 'success')
                } else if (result.isDenied) {
                    Swal.fire('Fields are not reset!', '', 'error')
                }
            })
        });

        $('#helpIcon').click( function (){
            Swal.fire('Info!', 'A quick way to send a comment or a question to a developer', 'question')
        });
    </script>
@endsection