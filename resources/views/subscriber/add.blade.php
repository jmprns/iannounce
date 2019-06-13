@extends('layouts.app')

{{-- HTML Title --}}
@section('html-title')
Subscriber Add
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
Subscriber
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
<li>
	<a href="/subscriber">Subscriber</a>
</li>
<li>
	Add Subscriber
</li>
@endsection

{{-- Main Content --}}
@section('main-content')
<div class="row">
                            <div class="col-sm-12">
                                <div id="add-subscriber-whirl" class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Add Subscriber</b></h4>
                                    <p class="text-muted font-13 m-b-30">
                                        Please fill up the form with correct responding value
                                    </p>
                                    <form id="add-subscriber-form" class="form-horizontal" role="form">
                                      
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Full Name</label>
                                            <div class="col-md-2">
                                                <input type="text" id="lname" class="form-control" placeholder="Last Name">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="fname" class="form-control" placeholder="First Name">
                                            </div>
                                            <div class="col-md-1">
                                                <input type="text" id="mname" class="form-control" placeholder="MI">
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Department</label>
                                            <div class="col-md-6">
                                               <select class="select2 form-control" id="dept" data-placeholder="Choose Department ...">
                                                    @foreach($years as $year)
                                                    <option value="{{ $year->id }}">{{ $year->department->dept_name }} - {{ $year->year_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Contact Number</label>
                                            <div class="col-md-6">
                                               <input  id="number" type="text" class="form-control" placeholder="09XXXXXXXXX" required>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group">
                                            <label class="col-md-2"></label>
                                            <div class="col-md-10">
                                                <button type="reset" class="btn btn-danger btn-bordered waves-effect m-t-10 waves-light">Reset</button>
                                                <button type="submit" class="btn btn-success btn-bordered waves-effect m-t-10 waves-light">Add</button>
                                            </div>
                                            </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
@endsection

{{-- Top Page Js --}}
@section('js-top')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}" type="text/javascript"></script>
@endsection

{{-- Bottom Js Script --}}
@section('js-bot')
<script>
$(".select2").select2();

$('#add-subscriber-form').submit(function(e){

    e.preventDefault();

    var token = $("meta[name='_token']").attr("content");

    $.ajax({
        url: "/subscriber/store",
        type: 'POST',
        dataType: 'json',
        data:{
            '_token' : token,
            'fname'	: $('#fname').val(),
            'lname' : $('#lname').val(),
            'mname' : $('#mname').val(),
            'dept' : $('#dept').val(),
            'number' : $('#number').val()
        },
        success:function(Result)
        {   
            toastr['success']("Subscriber has been registered.");
            $('#fname').val(''),
            $('#lname').val(''),
            $('#mname').val(''),
            $('#dept').val(''),
            $('#number').val('')
        },
        error: function(xhr)
        {
        	if(xhr.status == 406){
                var message_er = JSON.parse(xhr.responseText);
                toastr['error'](message_er['message']);
            }else if(xhr.status == 422){
                toastr['error']("All fields are required!");
            }
            
        },
        beforeSend: function(){
            var element = document.getElementById('add-subscriber-whirl');
            element.classList.add("whirl", "traditional");
        },
        complete: function(){
            var element = document.getElementById('add-subscriber-whirl');
            element.classList.remove("whirl", "traditional");
        }
    });
});
</script>
@endsection