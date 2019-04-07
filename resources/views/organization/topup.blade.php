@extends('layouts.dash')

@section('title', 'Top Up units')

@section('content')
    <div class="col-md-12">

        <!--Card-->
        <div class="mask rgba-white-slight card mb-4">
            <!--Card header-->
            <div class="h6 card-header text-left">
                <span id="card_title" style="color: #0b5570; font-size: 18px;"> Update Units </span><br>
            </div>
            <!--Card header end-->
            <form method="POST" action="{{ route('savetopup') }}">

                {{ csrf_field() }}

                <!--Card content-->
                <div class="card-body">
                <div class="panel">
                    <!-- Nav tabs -->
                    <div class="panel-heading">
                        <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active"><span class="fa fa-upload mr-2"></span>To up Company</a></li>
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
                                    <span class="col-sm-3 my-auto text-md-right text-left" style="color: #887788;">Amount<span style="color: #ff312b;"> *</span></span>
                                    <input name="amount" type="text" class="form-control" placeholder="0.00">
                                </div>

                                <div class="col-sm-4">
                                    <span class="col-sm-3 my-auto text-md-right text-left" style="color: #887788;">Description<span style="color: #ff312b;"> *</span></span>
                                    <input name="description" type="text" class="form-control" placeholder="MCDSF23EWEW mpesa top up">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <span class="col-sm-4 my-auto text-md-right text-left" style="color: #887788;">Company<span style="color: #ff312b;"> *</span></span>
                                    <select class="sel form-control" name="organizationID">
                                            @foreach($orgs as $org)
                                                <option value="{{ $org->organizationID }}">{{ $org->companyName }}</option>
                                            @endforeach
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
