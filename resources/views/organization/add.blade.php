@extends('layouts.dash')

@section('title', 'Add Company')

@section('content')
    <div class="col-md-12">

        <!--Card-->
        <div class="mask rgba-white-slight card mb-4">
            <!--Card header-->
            <div class="h6 card-header text-left">
                <span id="card_title" style="color: #0b5570; font-size: 18px;"> Add Company </span><br>
            </div>
            <!--Card header end-->
            <form method="POST" action="{{ route('companies.save') }}">

                {{ csrf_field() }}

                <!--Card content-->
                <div class="card-body">
                <div class="panel">
                    <!-- Nav tabs -->
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active"><span class="fa fa-upload mr-2"></span>Register Company</a></li>
                    </ul>     
                    </div>
                    <!-- Nav tabs end -->

                    <!-- Tab panes -->
                    <div class="panel-body border border-top-0 rounded-bottom" style="background-color: #f4f7f9;">
                    <div class="tab-content mx-3">

                        @foreach($errors->all() as $message)
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @endforeach

                        @if( Session::has('processed') )
                        <div class="alert alert-{{ Session::Get('success') ? 'success' : 'danger' }}" role="alert">
                            {{  Session::Get('message') }} 
                        </div>
                        @endif

                        <!-- Tab 1 -->
                        <div id="home" class="tab-pane active">
                        <div class="pt-4 pb-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <span class="col-sm-3 my-auto text-md-right text-left" style="color: #887788;">Company Name<span style="color: #ff312b;"> *</span></span>
                                    <input name="name" type="text" class="form-control" placeholder="XYZ Ltd">
                                </div>

                                <div class="col-sm-4">
                                    <span class="col-sm-3 my-auto text-md-right text-left" style="color: #887788;">Type<span style="color: #ff312b;"> *</span></span>
                                    <select class="sel form-control" name="type">
                                            <option value="1">PrePay</option>
                                            <option value="9">PostPay</option>
                                    </select>
                                </div>
                            </div>
                            
                            <hr class="divider my-3">
                            <div class="row">
                            <div class="w-100">
                                <div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                                <div class="col-sm-6 mr-2 text-center">
                                    <input value="Save" class="btn_blue btn" type="submit">
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Tab panes end -->
                </div>
                </div>
                <!--Card content-->

            </form>
        </div>
        <!--/.Card-->
    </div>
@endsection
