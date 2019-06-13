@extends('layouts.app')

{{-- HTML Title --}}
@section('html-title')
Announcement Individual
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
Announcement
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
<li>
    Announcement
</li>
<li>
    Individual
</li>
@endsection

{{-- Main Content --}}
@section('main-content')
<div class="row">
    <div class="col-sm-12">
        <div id="announce-form-whirl" class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Announce to One</b></h4>
            <p class="text-muted font-13 m-b-30">
                Please fill up the form with correct responding value
            </p>
            <form id="announce-form" class="form-horizontal" role="form">
              
                <div class="form-group">
                    <label class="col-md-2 control-label">Title</label>
                    <div class="col-md-6">
                       <input  id="announce-title" type="text" class="form-control" placeholder="Announcement Title" required>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Target</label>
                    <div class="col-md-6">
                       <select id="announce-target" class="dept-year form-control select2" data-placeholder="Choose Subscriber...">
                            @foreach($subscribers as $subscriber)
                                <option value="{{ $subscriber->id }}">{{ $subscriber->lname }}, {{ $subscriber->fname }} {{ $subscriber->mname }}. - {{ $subscriber->number }}</option>
                            @endforeach                        
                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Message</label>
                    <div class="col-md-6">
                      <textarea id="announce-message" class="form-control" maxlength="220" rows="3" placeholder="Message limit is 220 character."></textarea>
                    </div>
                </div>
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
     $(".dept-year").select2();

$('#announce-form').submit(function(e){

    e.preventDefault();



    var token = $("meta[name='_token']").attr("content");
    var title = $('#announce-title').val();
    var target = $('#announce-target').val();
    var message = $('#announce-message').val();
    var password = $('#announce-password').val();

    if(title == '' || target == '' || message == '' || password == ''){
        toastr['error']("All fields are required.");
        return;
    }

    $.ajax({
        url: "/announcement/individual",
        type: 'POST',
        dataType: 'json',
        data:{
            '_token' : token,
            'target' : target,
            'title' : title,
            'message' : message,
            'password' : password
        },
        success:function(Result)
        {   
           toastr['success'](Result.message);
           $('#announce-form').trigger('reset');
           $(".dept-year").select2();

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