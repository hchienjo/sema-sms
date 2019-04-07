@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <!-- main wrapper -->
     <main class="bg_main" class="container-fluid">
            <div id="main_view" class="content row">
                <div class="content col-md-5">
                    <img class="first_logo" style="cursor: pointer;" src="images/brand-logo.png" onclick="window.location = '/'">
                    <ul class="navbar-nav w-100">
                    </ul>
                </div>
                <div class="center col-md-7 mt-4">
                    <div class="col-md-7 mt-4">
                        <p class="para main-font" style="font-family: avenir; color: #fff;">Use Instant Messaging<br>for Customer Service</p><br>
                        <p class="para" style="font-family: avenir; font-size: 1.4em; color: #fff;">Have realtime conversations with your <br>
                        customers and build relationships.</p><br>
                        <div id="btn_get_started" class="para">
                        <a href="{{ route('login') }}">
                            <input value="Get started today" class="btn_yellow btn col-sm-6 ml-2" type="submit">
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <!-- main wrapper end -->
@endsection