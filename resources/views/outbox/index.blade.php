@extends('layouts.app')

{{-- HTML Title --}}
@section('html-title')
Outbox
@endsection

{{-- Top Css --}}
@section('css-top')
<link href="{{ asset('vendor/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('vendor/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('vendor/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

{{-- Bottom Css --}}
@section('css-bot')

@endsection

{{-- Page Title --}}
@section('page-title')
Outbox
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
<li>
	Outbox
</li>
@endsection

{{-- Main Content --}}
@section('main-content')
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Outbox</b></h4>
            <p class="text-muted font-13 m-b-30">
                List of announcement that has been published.
            </p>

            <table id="outbox-datatables" class="table table-hover table-colored table-inverse">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
                </thead>
                	@php($x = 1)
                	@foreach($outbox as $message)
					<tr>
						<td>{{ $x++ }}</td>
						<td>{{ $message->title }}</td>
						<td>{{ $message->message }}</td>
						<td align="center">
							<a href="javascript:void(0)" title="Open" onclick="show_outbox('{{ $message->id }}')" class="table-action-btn h3"><i class="mdi mdi-outbox text-success"></i></a>
                    	</td>
					</tr>
					@endforeach
                <tbody>
                
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal --}}
<div id="outbox-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div id="outbox-modal-whirl" class="modal-dialog" style="width:55%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="custom-width-modalLabel">Outbox Message</h4>
            </div>
            <div class="modal-body">
                <h4><strong>Title</strong></h4>
                <p id="modal-title">Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                <hr>
                <h4><strong>Message</strong></h4>
                <p id="modal-message">Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
            	<hr>
            	<h4><strong>Details</strong></h4>
            	<br>
            	<div class="row">
            		<div class="col-md-6"><b>Type:</b> <span id="modal-type">Announce to All</span></div>
            		<div class="col-md-6"><b>Sender:</b> <span id="modal-sender">Ricardo Dalisay</span></div>
            	</div>
            	<br>
            	<div class="row">
	    			<div class="col-md-6"><b>Announce:</b> <span id="modal-announce">11/11/11 11:11 AM</span></div>
            	</div>
            	<br>
            	<div class="row">
            		<div class="col-md-12">
            			<p><b>Target:</b> <span id="modal-target">All</span></p>
            		</div>
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
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap.js') }}"></script>
@endsection

{{-- Bottom Js Script --}}
@section('js-bot')
<script type="text/javascript">
$(document).ready(function () {
    $('#outbox-datatables').dataTable();
});
</script>
<script type="text/javascript">
	function show_outbox(id){

		var element = document.getElementById('outbox-modal-whirl');
        element.classList.add("whirl", "traditional");

		$('#outbox-modal').modal('toggle');


		$.ajax({
	        url: "/message/outbox",
	        type: 'POST',
	        dataType: 'json',
	        data:{
	            '_token' : $("meta[name='_token']").attr("content"),
	            'id'	: id
	        },
	        success:function(Result)
	        {   
	            $('#modal-title').html(Result.title);
                $('#modal-message').html(Result.message);
	            $('#modal-type').html(Result.type);
	            $('#modal-sender').html(Result.sender);
                $('#modal-announce').html(Result.announce.date);
	            $('#modal-target').html(Result.receiver);
	        },
	        error: function(xhr)
	        {
	        	if(xhr.status == 500){
	        		toastr['error']("Server error.");
	        	}else{
	        		toastr['error']("Something went wrong.");
	        	}
	            
	        },
	        complete: function(){
	            var element = document.getElementById('outbox-modal-whirl');
	            element.classList.remove("whirl", "traditional");
	        }
    	});
	}

	function approve_message(id){

	}

	function delete_message(id){

	}
</script>
@endsection