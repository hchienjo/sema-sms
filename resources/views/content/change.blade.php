@extends('layouts.app')

@section('change')
    <div class="col-md-6">

        <!--Card-->
        <div class="mask rgba-white-slight card">
            <!--Card header-->
            <div class="h6 card-header text-left">
                <span id="card_title" style="color: #0b5570; font-size: 20px;"> Change your password</span><br>
            </div>
            <!--Card header end-->
            <form>

                <!--Card content-->
                <div class="card-body">

                        <form class="">
                            <div class="w-100">
                                <div class="w-100">
                                    <label>Enter your current password</label>
                                    <input style="font-family: avenir; border-radius: 8px;" id="et_pass" class="lost form-control mb-0 text-left pl-4 pr-4 pt-2 pb-2 h-25" 
                                    type="password" placeholder="Your current password" pattern=".{4,}" required title="4 characters minimum" maxlength="100" required>
                                    <label class="mt-2">Enter a new password</label>
                                    <input style="font-family: avenir; border-radius: 8px;" id="et_pass" class="lost form-control mb-0 text-left pl-4 pr-4 pt-2 pb-2 h-25" 
                                    type="password" placeholder="Your new password" pattern=".{4,}" required title="4 characters minimum" maxlength="100" required>
                                    <label class="mt-2">Confirm the new password</label>
                                    <input style="font-family: avenir; border-radius: 8px;" id="et_pass" class="lost form-control mb-0 text-left pl-4 pr-4 pt-2 pb-2 h-25" 
                                    type="password" placeholder="Confirm your new password" pattern=".{4,}" required title="4 characters minimum" maxlength="100" required>
                                </div>
                            </div>
                        </form>
                </div>
                <!--Card content-->

                <!--Card footer-->
                <div class="container-fluid m-auto card-footer">
                    <div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                        <div class="col-sm-6 mr-2 text-center">
                            <input value="Done" class="btn_blue btn" type="submit">
                        </div>
                    </div>
                </div>
                <!--Card footer-->

            </form>
        </div>
        <!--/.Card-->

    </div>
@endsection