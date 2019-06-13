@extends('layouts.app')

{{-- HTML Title --}}
@section('html-title')
Subscriber List
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
Subscriber
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
<li>
	Subscriber
</li>
@endsection

{{-- Main Content --}}
@section('main-content')
@if(session("message") == "sucess")
<div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <i class="mdi mdi-check-all"></i>
    <strong>Success!</strong> Subscriber has been deleted.
</div>
@elseif(session("message") == "error")
<div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Error!</strong> Subscriber not found.
</div>
@endif
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Subscriber List</b></h4>
            <p class="text-muted font-13 m-b-30">
                This is the complete subscriber list.
            </p>

            <table id="datatable" class="table table-hover table-colored table-inverse">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Department - Year</th>
                    <th>Number</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                	@php($x = 1)
                	@foreach($subscribers as $subscriber)
                	<tr> 
                		<td>{{ $x++ }}</td>
                		<td>{{ $subscriber->lname }}, {{ $subscriber->fname }} {{ $subscriber->mname }}.</td>
                		<td>{{ $subscriber->year->department->dept_name }} - {{ $subscriber->year->year_name }}</td>
                		<td>{{ $subscriber->number }}</td>
                		<td align="center">
                        	<a href="/subscriber/edit/{{ $subscriber->id }}" class="table-action-btn h3" title="Edit"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                        	<a href="/subscriber/delete/{{ $subscriber->id }}" class="table-action-btn h3" title="Delete"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                    	</td>
                	</tr>
                	@endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

{{-- Top Page Js --}}
@section('js-top')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap.js') }}"></script>
@endsection

{{-- Bottom Js Script --}}
@section('js-bot')
<script>
	$(document).ready(function () {
    $('#datatable').dataTable();
    
});
</script>
@endsection