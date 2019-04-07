<div class="col-md-6">

    <!--Card-->
    <div class="mask rgba-white-slight card mb-4">
        <!--Card header-->
        <div class="h6 card-header text-left">
            <span id="card_title" style="color: #0b5570; font-size: 18px;"> Bulk SMS</span><br>
            <span id="card_title" style="color: #0b5570; font-size: 14px;"> Send a message to a group of contacts. </span>
        </div>


        @if(Session::has('bulk'))
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
        @endif

        <!--Card header end-->
        <form action="{{ route('enqueue.bulk.blast') }}" method="POST">

            {{ csrf_field() }}

            <!--Card content-->
            <div class="card-body">
                <div class="row">
                    <label style="color: #686868;" class="label-text col-sm-3 control-label">Sender<span style="color: #ff312b;">*</span></label>

                    <div class="col-sm-9">
                        <select name="serviceID" class="custom-select w-100">
                            @foreach($senders as $sender)
                                <option value="{{ $sender->serviceID }}"> {{ $sender->serviceName }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <label style="color: #686868;" class="label-text col-sm-3 control-label">Contact Group<span style="color: #ff312b;">*</span></label>

                    <div class="col-sm-9">
                        <select name="contactGroupID" class="custom-select w-100">
                            @foreach($groups as $group)
                                <option value="{{ $group->contactGroupID }}"> {{ $group->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- <div class="w-100 text-right">
                    <div class="popup mt-2 mb-2 pers-link" onclick="popup(event)">
                        <span class="">Personalization instructions</span>
                    </div>
                </div> -->

                <div class="row mt-2">
                    <label style="color: #686868;" class="label-text col-sm-3 control-label">Text<span style="color: #ff312b;">*</span></label>

                    <div class="col-sm-9">
                        <textarea name="message" class="form-control mb-1" id="bulk_message" placeholder="Type your message here">.STOP *456*9*5#</textarea>
                        <span class="help-block">
                            <span name="bulkcountchars" id="bulkcountchars" class="text text-center" style="color: #ed9c28;">0</span> <span id="char1" style="color: #686868;">Characters</span>
                            <span name="bulkcountmsg" id="bulkcountmsg" class="text text-center" style="color: #ed9c28;">0</span> <span id="msg1" style="color: #686868;">Messages</span>
                        </span>
                    </div>
                </div>
                <div class="row mt-3">
                    <label style="color: #686868;" class="label-text col-sm-3 control-label">Schedule<span style="color: #ff312b;">*</span></label>

                    <div class="col-sm-9">
                        <div id="bulk_time" class="input-group bulk_time">
                            <input name="date" data-date-format="YYYY-MM-DD HH:mm:ss" required class="form-control" name="" type="date" required>
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
                        <input value="Reset" class="btn_grey btn" type="button">
                    </div>
                    <div class="col-sm-6 mr-2 text-center">
                        <input value="Schedule" class="btn_blue btn" type="submit">
                    </div>
                </div>
            </div>
            <!--Card footer-->

        </form>
    </div>
    <!--/.Card-->

</div>

<div class="col-md-6">

<!--Card-->
<div class="mask rgba-white-slight card mb-4">
    <div class="h6 card-header text-left">
        <span id="card_title" style="color: #0b5570; font-size: 18px;"> Express SMS</span><br>
        <span id="card_title" style="color: #0b5570; font-size: 14px;"> Send a message to a single phone number, or list of numbers separated by commas or spaces. </span>
    </div>

    @if( Session::has('express') )
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
    @endif


    <form action="{{ route('enqueue.express') }}" method="POST">
        {{ csrf_field() }}
        <!--Card content-->
        <div class="card-body">
            <div class="row">
                <label style="color: #686868;" class="label-text col-sm-3 control-label">Sender<span style="color: #ff312b;">*</span></label>

                <div class="col-sm-9">
                    <select name="serviceID" class="custom-select w-100">
                        @foreach($senders as $sender)
                            <option value="{{ $sender->serviceID }}"> {{ $sender->serviceName }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <label style="color: #686868;" class="label-text col-sm-3 control-label">Phone<span style="color: #ff312b;">*</span></label>

                <div class="col-sm-9">
                    <input name="msisdns" type="text" class="form-control" required placeholder="eg. 254701234567">
                </div>
            </div>
            <div class="row mt-3">
                <label style="color: #686868;" class="label-text col-sm-3 control-label">Text<span style="color: #ff312b;">*</span></label>

                <div class="col-sm-9">
                    <textarea name="message" class="form-control mb-1" id="express_message" placeholder="Type your message here"></textarea>
                    <span class="help-block">
                        <span name="expresscountchars" id="expresscountchars" class="text text-center" style="color: #ed9c28;">0</span> <span id="char2" style="color: #686868;">Characters</span>
                        <span name="expresscountmsg" id="expresscountmsg" class="text text-center" style="color: #ed9c28;">0</span> <span id="msg2" style="color: #686868;">Messages</span>
                    </span>
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
                    <input value="Send" class="btn_blue btn" type="submit">
                </div>
            </div>
        </div>
        <!--Card footer-->
    </form>
</div>
<!--/.Card-->

<!--Card-->
<div class="mask rgba-white-slight card mb-4">
    <div class="h6 card-header text-left">
        <span id="card_title" style="color: #0b5570; font-size: 18px;"> Custom Bulk SMS </span><br>
        <span id="card_title" style="color: #0b5570; font-size: 14px;"> 
            Send a custom message to a group of contacts with fields data contained in an uploaded file.
            Download <a href="{{ asset('storage/sample.csv') }}">sample</a> file.
        </span>
    </div>

    @if(Session::has('custom'))
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
    @endif

    <form action="{{ route('enqueue.custom.blast') }}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}

        <!--Card content-->
        <div class="card-body">
            <div class="row">
                <label style="color: #686868;" class="label-text col-sm-3 control-label">Sender<span style="color: #ff312b;">*</span></label>

                <div class="col-sm-9">
                    <select name="serviceID" class="custom-select w-100">
                        @foreach($senders as $sender)
                            <option value="{{ $sender->serviceID }}"> {{ $sender->serviceName }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <label style="color: #686868;" class="label-text col-sm-3 control-label">Contact File<span style="color: #ff312b;">*</span></label>

                <div class="col-sm-9" >
                    <p class="my-auto ml-0 ml-auto">[Maximum 128MB .csv ]</p>
                    <input name="file" type="file" class="pr-0" accept=".csv">
                </div>
            </div>

            <div class="row mt-3">
                <label style="color: #686868;" class="label-text col-sm-3 control-label">Text<span style="color: #ff312b;">*</span></label>

                <div class="col-sm-9">
                    <textarea name="message" class="form-control mb-1" id="cus_bulk_message" placeholder="Hi {name}, please pay by {date} for your account: {account}."></textarea>
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
    </form>

</div>
<!--/.Card-->

</div>
