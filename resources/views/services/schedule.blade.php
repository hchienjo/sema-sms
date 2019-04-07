@extends('layouts.dash')

@section('title', 'Schedule Content')

@section('content')

    <div class="container">
    <form action="{{ route('enqueue.content', ['productID' => $service->productID ])}}" method="POST">
            {{ csrf_field() }}
        <!--Card-->
            <div class="mask rgba-white-slight card mb-4">
                <div class="h6 card-header text-left">
                    <span id="card_title" style="color: #0b5570; font-size: 18px;"> Schedule Content </span><br>
                    <span id="card_title" style="color: #0b5570; font-size: 14px;"> Schedule message for {{ $service->serviceNameSlug() }} subscribers. </span>
                </div>

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

                <!--Card content-->
                <div class="card-body">

                    <div class="row mt-3">
                        <label style="color: #686868;" class="label-text col-sm-3 control-label">Text<span style="color: #ff312b;">*</span></label>

                        <div class="col-sm-9">
                            <textarea name="message" class="form-control mb-1" id="cus_bulk_message" placeholder="Type your message here"></textarea>
                            <span class="help-block">
                                <span name="cus_bulkcountchars" id="cus_bulkcountchars" class="text text-center" style="color: #ed9c28;">0</span> <span id="char3" style="color: #686868;">Characters</span>
                                <span name="cus_bulkcountmsg" id="cus_bulkcountmsg" class="text text-center" style="color: #ed9c28;">0</span> <span id="msg3" style="color: #686868;">Messages</span>
                            </span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <label style="color: #686868;" class="label-text col-sm-3 control-label">Schedule<span style="color: #ff312b;">*</span></label>

                        <div class="col-sm-9">
                            <div id="bulk_time" class="input-group bulk_time">
                                <input name="date" data-date-format="YYYY-MM-DD HH:mm:ss" required class="form-control" name="" type="date">
                                <input name="time" data-date-format="YYYY-MM-DD HH:mm:ss" required class="form-control" name="" type="time">
                                <span class="input-group-addon m-auto">
                                    <span style="font-size: 1.55em;" class="ti-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
                <!--Card content-->


                <!--Card footer-->
                <div class="container-fluid m-auto card-footer">
                    <div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                        <div class="col-sm-6 mr-2 text-center">
                            <input value="Reset" class="btn_grey btn" type="submit">
                        </div>
                        <div class="col-sm-6 mr-2 text-center">
                            <input value="Dispatch" class="btn_blue btn" type="submit">
                        </div>
                    </div>
                </div>
                <!--Card footer-->

            </div>
        </div>
    </form>
@endsection
