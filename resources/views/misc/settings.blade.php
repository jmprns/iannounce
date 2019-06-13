@extends('layouts.app')

{{-- HTML Title --}}
@section('html-title')

@endsection

{{-- Top Css --}}
@section('css-top')

@endsection

{{-- Bottom Css --}}
@section('css-bot')
<link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

{{-- Page Title --}}
@section('page-title')
Settings
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
<li>Settings</li>
@endsection

{{-- Main Content --}}
@section('main-content')
<div class="row">
    <div class="col-md-6">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">System Information</h4>
             <table class="table table table-hover m-0">
                            <thead>
                                <tr>
                                    <th width="60%">Information</th>
                                    <th width="40%">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>System Name</td>
                                    <td>iAnnounce</td>
                                </tr>
                                <tr>
                                    <td>Markup Layout</td>
                                    <td>HTML5/CSS3-Bootstrap</td>
                                </tr>
                                <tr>
                                    <td>Programming Language</td>
                                    <td>PHP-OOP</td>
                                </tr>
                                <tr>
                                    <td>PHP Version</td>
                                    <td>7</td>
                                </tr>
                                <tr>
                                    <td>PHP Framework</td>
                                    <td>Laravel 5.6</td>
                                </tr>
                                <tr>
                                    <td>Database</td>
                                    <td>iannounce</td>
                                </tr>
                                <tr>
                                    <td>Installed Date</td>
                                    <td></td>
                                </tr>
                            </tbody>
                </table>  
        </div>
    </div> <!-- end col -->

    <div class="col-md-6">
        <div id="profile-whirl" class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Settings</h4>
            <ul class="nav nav-tabs tabs-bordered nav-justified">
                <li class="active">
                    <a href="#set-1" data-toggle="tab" aria-expanded="true">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">Profile</span>
                    </a>
                </li>
                <li class="">
                    <a href="#set-2" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">Account</span>
                    </a>
                </li>
                <li class="">
                    <a href="#set-3" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">Department</span>
                    </a>
                </li>
                <li class="">
                    <a href="#set-4" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">SMS</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="set-1">
                   	<div class="row">
                        <form id="profile-info" method="POST">
                        <div class="form-group">
                            <div class="col-md-5">
                                <input type="text" id="admin-lname" class="form-control" placeholder="Last Name" value="{{ Auth::user()->lname }}" required>
                            </div>
                            <div class="col-md-5">
                                <input type="text" id="admin-fname" class="form-control" placeholder="First Name" value="{{ Auth::user()->fname }}" required>
                            </div>
                            <div class="col-md-2">
                                <input type="text" id="admin-mname" class="form-control" placeholder="MI" value="{{ Auth::user()->mname }}" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    	<div class="form-group">
                    		<div class="col-md-12">
                    			<input type="text" id="admin-email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                    		</div>
                    	</div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="password" id="admin-pass" class="form-control" placeholder="New password" >
                            </div>
                            <div class="col-md-6">
                                <input type="password" id="admin-cpass" class="form-control" placeholder="Confirm password">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    	<div class="col-md-12">
                    		<button type="submit" class="btn btn-primary btn-block">Save</button>
                    	</div>
                    </div>
                </form>
                </div>
                <div class="tab-pane" id="set-2">
                   <div class="row">
                    <form method="POST" id="add-admin-form">
                        <div class="form-group">
                            <div class="col-md-5">
                                <input type="text" id="new-lname" class="form-control" placeholder="Last Name" required>
                            </div>
                            <div class="col-md-5">
                                <input type="text" id="new-fname" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="col-md-2">
                                <input type="text" id="new-mname" class="form-control" placeholder="MI" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    	<div class="form-group">
                    		<div class="col-md-12">
                    			<input type="email" id="new-email" class="form-control" placeholder="Email address">
                    		</div>
                    	</div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="password" id="new-pass" class="form-control" placeholder="New password" required>
                            </div>
                            <div class="col-md-6">
                                <input type="password" id="new-cpass" class="form-control" placeholder="Confirm password" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    	<div class="col-md-12">
                    		<button class="btn btn-primary btn-block" type="submit">Add admin</button>
                    	</div>
                    </div>
                </form>
                </div>
                <div class="tab-pane" id="set-3">
                       <div class="row">
                    <div class="col-md-4"><hr></div>
                    <div class="col-md-4 text-center"><h4 class="header-title">Add</h4></div>
                    <div class="col-md-4"><hr></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="#" data-toggle="modal" data-target="#modal-add-dept" class="btn btn-block btn-bordered btn-primary">Add Department</a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" data-toggle="modal" data-target="#modal-add-year" class="btn btn-block btn-bordered btn-success">Add Year</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" data-toggle="modal" data-target="#modal-dept-map" class="btn btn-block btn-bordered btn-inverse">Department Map</a>
                    </div>
                </div>
                </div>
                <div class="tab-pane" id="set-4">
                    Hello World
                </div>
            </div>
        </div>
    </div> <!-- end col -->   
</div>
{{-- Modal ADD DEPT --}}
<div id="modal-add-dept" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="modal-add-dept-whirl" class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Add Department</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                                <select id="dept-select1" class="form-control">
                                    <option>Choose...</option>
                                    <option value="1">Junior High School</option>
                                    <option value="2">Senior High School</option>
                                    <option value="3">College</option>
                                </select>
                        </div>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                                <input type="text" class="form-control" id="dept-name" required placeholder="Department Name">
                        </div>
                    </div>
                </div>
                <button type="submit" onclick="add_dept()" class="btn btn-lg btn-block btn-primary">Add</button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- Modal ADD YEAR --}}
<div id="modal-add-year" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="modal-add-year-whirl" class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Add Year</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                                <select id="dept-select" class="form-control">
                                    <option>Choose...</option>
                                    @foreach($department as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->dept_name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                                <input type="text" class="form-control" id="year-name" required placeholder="Year Name">
                        </div>
                    </div>
                </div>

                <button type="submit" onclick="add_year()" class="btn btn-lg btn-block btn-primary">Add</button>
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- Modal DEPT MAP --}}
<div id="modal-dept-map" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="dept-map-whirl" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Department Map</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach($department as $dept)
                   <div class="col-md-6">
                       <details>
                      <summary><span class="text-primary lead m-t-0">{{ $dept->dept_name }}</span></summary>
                        <ul>
                            <li><a href="#" onclick="delete_dept('{{ $dept->id }}')">Delete Department</a></li>
                            @foreach($dept->year as $year)
                                <li>{{ $dept->dept_name }} - {{ $year->year_name }} | <a href="#" onclick="delete_year('{{ $year->id }}')">Delete</a></li>
                            @endforeach
                        </ul>
                    </details>
                   </div>
                @endforeach
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

{{-- Top Page Js --}}
@section('js-top')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@endsection

{{-- Bottom Js Script --}}
@section('js-bot')
<script>
$("#dept-select").select2();
$("#dept-select1").select2();
$('#profile-info').submit(function(e){

    e.preventDefault();

    if($('#admin-pass').val() !== $('#admin-cpass').val()){
        toastr['error']("Password mismatch.");
        return;
    }

    $.ajax({
        url: "/settings",
        type: 'POST',
        dataType: 'json',
        data:{
            '_token' : $("meta[name='_token']").attr("content"),
            'setId' : '1',
            'fname' : $('#admin-fname').val(),
            'lname' : $('#admin-lname').val(),
            'mname' : $('#admin-mname').val(),
            'pass' : $('#admin-pass').val(),
            'cpass' : $('#admin-cpass').val()
        },
        success:function(Result)
        {   
            toastr['success']("Your information has been updated.");
        },
        error:function(xhr){

            if(xhr.status == 406){
                var message_er = JSON.parse(xhr.responseText);
                toastr['error'](message_er['message']);
            }else{
                 toastr['error']("Something went wrong. Error code: "+xhr.status+".");
            }

        },
        beforeSend: function(){
            var element = document.getElementById('profile-whirl');
            element.classList.add("whirl", "traditional");
        },
        complete: function(){
            var element = document.getElementById('profile-whirl');
            element.classList.remove("whirl", "traditional");
        }
    });
});

$('#add-admin-form').submit(function(e){

    e.preventDefault();

    if($('#new-pass').val() !== $('#new-cpass').val()){
        toastr['error']("Password mismatch.");
        return;
    }

    $.ajax({
        url: "/settings",
        type: 'POST',
        dataType: 'json',
        data:{
            '_token' : $("meta[name='_token']").attr("content"),
            'setId' : '2',
            'fname' : $('#new-fname').val(),
            'lname' : $('#new-lname').val(),
            'mname' : $('#new-mname').val(),
            'email' : $('#new-email').val(),
            'pass' : $('#new-pass').val(),
            'cpass' : $('#new-cpass').val()
        },
        success:function(Result)
        {   
            toastr['success']("New admin has been added.");
        },
        error:function(xhr){

            if(xhr.status == 406){
                var message_er = JSON.parse(xhr.responseText);
                toastr['error'](message_er['message']);
            }else{
                 toastr['error']("Something went wrong. Error code: "+xhr.status+".");
            }

        },
        beforeSend: function(){
            var element = document.getElementById('profile-whirl');
            element.classList.add("whirl", "traditional");
        },
        complete: function(){
            var element = document.getElementById('profile-whirl');
            element.classList.remove("whirl", "traditional");
        }
    });
});

function add_dept(){

    $.ajax({
        url: "/settings",
        type: 'POST',
        dataType: 'json',
        data:{
            '_token' : $("meta[name='_token']").attr("content"),
            'setId' : '3',
            'name' : $('#dept-name').val(),
            'lvl' : $('#dept-select1').val()
        },
        success:function(Result)
        {   
            $('#modal-add-dept').modal('toggle');
            toastr['success']("Department has been added.");
            location.reload();
        },
        error:function(xhr){

            if(xhr.status == 406){
                var message_er = JSON.parse(xhr.responseText);
                toastr['error'](message_er['message']);
            }else{
                 toastr['error']("Something went wrong. Error code: "+xhr.status+".");
            }

        },
        beforeSend: function(){
            var element = document.getElementById('modal-add-dept-whirl');
            element.classList.add("whirl", "traditional");
        },
        complete: function(){
            var element = document.getElementById('modal-add-dept-whirl');
            element.classList.remove("whirl", "traditional");
        }
    });
}

function add_year(){

    $.ajax({
        url: "/settings",
        type: 'POST',
        dataType: 'json',
        data:{
            '_token' : $("meta[name='_token']").attr("content"),
            'setId' : '4',
            'name' : $('#year-name').val(),
            'dept' : $('#dept-select').val()
        },
        success:function(Result)
        {   
            $('#modal-add-year').modal('toggle');
            toastr['success']("Year has been added.");
            location.reload();
        },
        error:function(xhr){

            if(xhr.status == 406){
                var message_er = JSON.parse(xhr.responseText);
                toastr['error'](message_er['message']);
            }else{
                 toastr['error']("Something went wrong. Error code: "+xhr.status+".");
            }

        },
        beforeSend: function(){
            var element = document.getElementById('modal-add-year-whirl');
            element.classList.add("whirl", "traditional");
        },
        complete: function(){
            var element = document.getElementById('modal-add-year-whirl');
            element.classList.remove("whirl", "traditional");
        }
    });
}

function delete_dept(id){

    if(confirm("Are you sure to delete the department?")){
        $('#modal-dept-map').modal('toggle');
        $.ajax({
            url: "/settings",
            type: 'POST',
            dataType: 'json',
            data:{
                '_token' : $("meta[name='_token']").attr("content"),
                'setId' : '5',
                'id' : id
            },
            success:function(Result)
            {   toastr['success']("Department has been deleted.");
                location.reload();
            },
            error:function(xhr){

                if(xhr.status == 406){
                    var message_er = JSON.parse(xhr.responseText);
                    toastr['error'](message_er['message']);
                }else{
                     toastr['error']("Something went wrong. Error code: "+xhr.status+".");
                }

            },
            beforeSend: function(){
                var element = document.getElementById('profile-whirl');
                element.classList.add("whirl", "traditional");
            },
            complete: function(){
                var element = document.getElementById('profile-whirl');
                element.classList.remove("whirl", "traditional");
            }
        });
    }else{


    }

}

function delete_year(id){

    if(confirm("Are you sure to delete the year level?")){
        $('#modal-dept-map').modal('toggle');
        $.ajax({
            url: "/settings",
            type: 'POST',
            dataType: 'json',
            data:{
                '_token' : $("meta[name='_token']").attr("content"),
                'setId' : '6',
                'id' : id
            },
            success:function(Result)
            {   toastr['success']("Year level has been deleted.");
                location.reload();
            },
            error:function(xhr){

                if(xhr.status == 406){
                    var message_er = JSON.parse(xhr.responseText);
                    toastr['error'](message_er['message']);
                }else{
                     toastr['error']("Something went wrong. Error code: "+xhr.status+".");
                }

            },
            beforeSend: function(){
                var element = document.getElementById('profile-whirl');
                element.classList.add("whirl", "traditional");
            },
            complete: function(){
                var element = document.getElementById('profile-whirl');
                element.classList.remove("whirl", "traditional");
            }
        });
    }else{


    }

}
</script>
@endsection