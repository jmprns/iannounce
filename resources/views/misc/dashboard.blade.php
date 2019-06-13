@extends('layouts.app')

{{-- HTML Title --}}
@section('html-title')
Dashboard
@endsection

{{-- Top Css --}}
@section('css-top')

@endsection

{{-- Bottom Css --}}
@section('css-bot')

@endsection

{{-- Page Title --}}
@section('page-title')
Dashboard
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
<li>
	Dashboard
</li>
@endsection

{{-- Main Content --}}
@section('main-content')
<div class="row">

                            <div class="col-lg-3 col-md-6">
                                <div class="card-box widget-box-three">
                                    <div class="bg-icon pull-left">
                                        <i class="ti-user"></i>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-success m-t-5 text-uppercase font-600 font-secondary">Subscribers</p>
                                        <h2 class="m-b-10"><span data-plugin="counterup">{{ $count['subscriber'] }}</span></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="card-box widget-box-three">
                                    <div class="bg-icon pull-left">
                                        <i class="ti-comment"></i>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-success m-t-5 text-uppercase font-600 font-secondary">Outbox</p>
                                        <h2 class="m-b-10"><span data-plugin="counterup">{{ $count['outbox'] }}</span></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="card-box widget-box-three">
                                    <div class="bg-icon pull-left">
                                        <i class="ti-signal"></i>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-success m-t-5 text-uppercase font-600 font-secondary">Ozeki Status</p>
                                        <h2 class="m-b-10"><span data-plugin="counterup">{{ $count['ozeki'] }}</span></h2>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="card-box widget-box-three">
                                    <div class="bg-icon pull-left">
                                        <i class="ti-time"></i>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-success m-t-5 text-uppercase font-600 font-secondary">{{ strtoupper(date("l",time())) }}</p>
                                        <h2 class="m-b-10">{{ date("H:i", time()) }}</h2>
                                    </div>
                                </div>
                            </div>
</div>
<div class="row">
    <div class="col-lg-7">
        <div class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Recent Registered Subscriber</h4>

            <div class="table-responsive">
                <table class="table table table-hover m-0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Department - Year</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subscribers as $sbs)
                            <tr>
                                <td></td>
                                <td>{{ $sbs->fname }} {{ $sbs->mname }}. {{ $sbs->lname }}</td>
                                <td>{{ $sbs->year->department->dept_name }} - {{ $sbs->year->year_name }}</td>
                                <td>{{ $sbs->number }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div> <!-- table-responsive -->
        </div> <!-- end card -->
    </div>
    <div class="col-lg-5">
        <div id="quick-sms-whirl" class="card-box">
            <h4 class="header-title m-t-0 m-b-30">Quick SMS Message</h4>
            <form id="quick-sms">
            <div class="form-group">
                <label for="phoneNumber">Cellphone Number</label>
                <input type="number" class="form-control" id="phoneNumber" placeholder="09XXXXXXXXXXX">
            </div>
            <div class="form-group">
                <label for="announce-message">Message</label>
                <textarea id="announce-message" class="form-control" maxlength="160" rows="3" placeholder="Message limit is 160 character."></textarea>
            </div>
            <div class="form-group">
                <button type="reset" class="btn btn-danger btn-bordered waves-effect m-t-10 waves-light">Reset</button>
                <button type="submit" class="btn btn-success btn-bordered waves-effect m-t-10 waves-light">Send</button>
            </div>
            </form>
        </div> <!-- end card -->
    </div>
</div>
@endsection

{{-- Top Page Js --}}
@section('js-top')

@endsection

{{-- Bottom Js Script --}}
@section('js-bot')
<script type="text/javascript">
    $('#quick-sms').submit(function(e){

    e.preventDefault();

    var token = $("meta[name='_token']").attr("content");
    var message = $('#announce-message').val();
    var number = $('#phoneNumber').val();

    
    if(number == '' || message == ''){
        toastr['error']("All fields are required.");
        return;
    }

    $.ajax({
        url: "/dashboard",
        type: 'POST',
        dataType: 'json',
        data:{
            '_token' : token,
            'message' : message,
            'number' : number
        },
        success:function(Result)
        {   
           toastr['success'](Result.message);
           $('#quick-sms').trigger('reset');

        },
        error:function(xhr){

            if(xhr.status == 406){
                var message_er = JSON.parse(xhr.responseText);
                toastr['error'](message_er['message']);
            }else if(xhr.status == 422){
                toastr['error']("All fields are required!");
            }else{
                 toastr['error']("Something went wrong. Error code: "+xhr.status+".");
            }

        },
        beforeSend: function(){
            var element = document.getElementById('quick-sms-whirl');
            element.classList.add("whirl", "traditional");
        },
        complete: function(){
            var element = document.getElementById('quick-sms-whirl');
            element.classList.remove("whirl", "traditional");
        }
    });
});
</script>
@endsection