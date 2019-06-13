@extends('layouts.app')

{{-- HTML Title --}}
@section('html-title')

@endsection

{{-- Top Css --}}
@section('css-top')
<link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

{{-- Bottom Css --}}
@section('css-bot')

@endsection

{{-- Page Title --}}
@section('page-title')
Compose
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
<li>
    Outbox
</li>
<li>
    Compose
</li>
@endsection

{{-- Main Content --}}
@section('main-content')
<div class="row">
    <div class="col-sm-12">
        <div id="announce-form-whirl" class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Direct SMS</b></h4>
            <p class="text-muted font-13 m-b-30">
                Please fill up the form with correct responding value
            </p>
            <form id="announce-form" class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-md-2 control-label">Phone Number</label>
                    <div class="col-md-6">
                       <input  id="announce-target" type="text" class="form-control" placeholder="09XXXXXXXXX" required>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Message</label>
                    <div class="col-md-6">
                      <textarea id="announce-message" class="form-control" maxlength="220" rows="3" placeholder="Message limit is 220 character."></textarea>
                    </div>
                </div>
                <div class="clearfix"></div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                    <label class="col-md-2 control-label">Password</label>
                    <div class="col-md-6">
                       <input type="password" id="announce-password" class="form-control" placeholder="Enter your password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2"></label>
                    <div class="col-md-10">
                        <button type="reset" class="btn btn-danger btn-bordered waves-effect m-t-10 waves-light">Reset</button>
                        <button type="submit" class="btn btn-success btn-bordered waves-effect m-t-10 waves-light">Publish</button>
                    </div>
                    </div>
            </form>
            
        </div>
    </div>
</div>
@endsection

{{-- Top Page Js --}}
@section('js-top')
<script src="{{ asset('vendor/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>

@endsection

{{-- Bottom Js Script --}}
@section('js-bot')
<script type="text/javascript">
$('textarea#announce-message').maxlength({
    alwaysShow: true
});

$('#announce-form').submit(function(e){

    e.preventDefault();

    var token = $("meta[name='_token']").attr("content");
    var number = $('#announce-target').val();
    var message = $('#announce-message').val();
    var password = $('#announce-password').val();


    if(number == '' || message == '' || password == ''){
        toastr['error']("All fields are required.");
        return;
    }

    $.ajax({
        url: "/message/compose",
        type: 'POST',
        dataType: 'json',
        data:{
            '_token' : token,
            'number' : number,
            'message' : message,
            'password' : password
        },
        success:function(Result)
        {   
           toastr['success'](Result.message);
           $('#announce-form').trigger('reset');

        },
        error:function(xhr){

            if(xhr.status == 406){
                var message_er = JSON.parse(xhr.responseText);
                toastr['error'](message_er['message']);
            }else if(xhr.status == 422){
                toastr['error']("All fields are required!");
            }else if(xhr.status == 200){
                 
            }else{
                toastr['error']("Something went wrong. Error code: "+xhr.status+".");
            }

        },
        beforeSend: function(){
            var element = document.getElementById('announce-form-whirl');
            element.classList.add("whirl", "traditional");
        },
        complete: function(){
            var element = document.getElementById('announce-form-whirl');
            element.classList.remove("whirl", "traditional");
        }
    });
});
</script>
@endsection