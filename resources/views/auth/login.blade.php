@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <main class="bg_login" class="container-fluid">
        <div id="main_view" class="content row mx-4">
            <div class="center2 content col-md-5">
                <img class="login_logo" style="cursor: pointer;" src="images/brand-logo.png" onclick="window.location = '/'">
                <div class="w-100" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <span class="text-center lost" style="text-align: center; font-family: avenir; padding-bottom: 0.5rem; 
                    padding-top: 0.5rem; color: #fff; font-size: 1.8rem;">Get started</span>
                </div>
                <div class="container" style="display: flex; flex-direction: column">

                <form id="" class="" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="w-100">
                        <div class="w-100">
                            <input style="font-family: avenir; border-radius: 8px;" id="et_email" class="{{ $errors->has('email') ? 'is-invalid' : '' }} lost form-control 
                            text-left pl-4 pr-4 pt-2 pb-2 mt-3 h-25" type="text" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,3}$" 
                            maxlength="150" title="example@email.com" placeholder="Your email address" name="email">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif

                            <input style="font-family: avenir; border-radius: 8px;" id="et_pass" class="lost form-control {{ $errors->has('password') ? 'is-invalid' : '' }} mt-3 mb-0 text-left pl-4 pr-4 pt-2 pb-2 h-25" 
                            type="password" placeholder="Your password" pattern=".{4,}" required title="4 characters minimum" maxlength="100" required name="password">
                        </div>
                    </div>

                    <div style="font-family: avenir; text-align: right;" class="p-2 lost">
                        <a id="btn_forgot"><span class="text-white btn btn-link" style="font-size: 1.1em;">forgot password?</span></a>
                    </div>
                        <button class="btn text-center w-100 lost" style="font-family: avenir; padding-bottom: 0.5rem; padding-top: 0.5rem; 
                        font-weight: bold; color: #fff;  border-radius: 8px; background: #ff8300;">Log In</button>
                    <div class="pt-2 pb-2 text-center">
                    <hr  style="background: #fff">
                    </div>

                    <div class="row pl-3 pr-3 text-center">
                        <span class="col-md-6 lost" style="text-align: right; font-family: avenir; padding-bottom: 0.5rem; padding-top: 0.5rem; 
                        color: #fff;">Don’t have an account?</span>
                        <a href="/register" id="reg_button" class="trans btn col-md-6 lost" style="font-family: avenir; padding-bottom: 0.5rem; padding-top: 0.5rem; font-weight: 
                        bold; color: #fff; border-radius: 8px; background: #ff8300;">Register</a>
                    </div>

                    <div class="w-100 mt-4 mb-4" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        <span class="text-center lost" style="text-align: center; font-family: avenir; padding-bottom: 0.5rem; padding-top: 0.5rem; 
                        color: #fff;">Get your business on Instant Messaging today.</span>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </main>
    <!-- main wrapper end -->
@endsection