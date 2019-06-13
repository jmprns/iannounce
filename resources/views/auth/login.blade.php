<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="_token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('media/favicon.ico')}}">
        <!-- App title -->
        <title>iAnnounce - Login</title>

        {{-- Sweet Alert --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/swal/sweet-alert.css') }}">

        <!-- App css -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/core.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/components.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/pages.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/menu.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('vendor/whirl/whirl.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')}}"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js')}}"></script>
        <![endif]-->


    </head>


    <body class="bg-transparent">

        <!-- HOME -->
        <section>
            <div id="login-body" class="container-alt">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">
                            <div class="clearfix"></div>
                            <div class="m-t-40 account-pages">
                                <div class="text-center account-logo-box">
                                    {{-- <h2 class="text-uppercase">
                                        <a href="index.html" class="text-success">
                                            <span><img src="{{asset('media/logo2.png')}}" alt="" height="50"></span>
                                        </a>
                                    </h2> --}}
                                    <h4 class="text-uppercase font-bold m-b-0" style="color: white;"><i class="mdi mdi-star-circle"></i> LOG IN <i class="mdi mdi-star-circle"></i></h4>
                                    <h2 class="text-uppercase font-bold m-b-0" style="color: white;">IANNOUNCE</h2>
                                </div>
                                <div class="account-content">
                                    <form method="POST" id="login-form" class="form-horizontal" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                        @csrf
                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <input class="form-control" id="email" type="email" placeholder="Email Address" name="email" value="{{ old('email') }}" required autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <div class="checkbox checkbox-success">
                                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="remember">
                                                        Remember me
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group account-btn text-center m-t-10">
                                            </form>
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-bordered btn-danger waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </div>

                                    

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->


                           

                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/detect.js') }}"></script>
        <script src="{{ asset('js/fastclick.js') }}"></script>
        <script src="{{ asset('js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('js/waves.js') }}"></script>
        <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ asset('vendor/switchery/switchery.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('js/jquery.core.js') }}"></script>
        <script src="{{ asset('js/jquery.app.js') }}"></script>

        <script type="text/javascript">
            $('#login-form').submit(function(e){
                var element = document.getElementById('login-body');
                element.classList.add("whirl", "traditional");
            });
        </script>

    </body>
</html>