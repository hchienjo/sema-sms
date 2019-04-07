@extends('layouts.app')

@section('support')
    <div class="col-md-6">

        <!--Card-->
        <div class="mask rgba-white-slight card">
            <!--Card header-->
            <div class="h6 card-header text-left">
                <span id="card_title" style="color: #0b5570; font-size: 20px;"> Our Contacts</span><br>
            </div>
            <!--Card header end-->
            <form>

                <!--Card content-->
                <div class="card-body">
                        <ul class="list list-icons list-icons-style-3 mt-xlg" style="color: #686868;">
                            <li><i class="fa fa-map-marker"></i> <strong>Address:</strong> Creative Brands group,Parklands Plaza, Nairobi, Kenya</li>
                            <li><i class="fa mt-2 fa-phone"></i> <strong>Phone:</strong> (020) 2 696-969</li>
                            <li><i class="fa mt-2 fa-mobile-phone"></i> <strong>Mobile:</strong> (020) 696-969</li>
                            <li><i class="fa mt-2 fa-envelope"></i> <strong>Email:</strong> <a href="mailto:info@creativebrands.co.ke">info@creativebrands.co.ke</a></li>
                            <li><i class="fa mt-2 fa-globe"></i> <strong>Web:</strong> <a href="www.creativebrands.co.ke">www.creativebrands.co.ke</a></li>
                        </ul>

                </div>
                <!--Card content-->


            </form>
        </div>
        <!--/.Card-->

    </div>
    <div class="col-md-6">

        <!--Card-->
        <div class="mask rgba-white-slight card mb-4">
            <div class="h6 card-header text-left">
                <span id="card_title" style="color: #0b5570; font-size: 20px;"> Write to us </span><br>
            </div>

            <form>

                <!--Card content-->
                <div class="card-body">
                    <div class="row">
                        <label style="color: #686868;" class="label-text col-sm-3 control-label">Enquiry <span style="color: #ff312b;">*</span></label>

                        <div class="col-sm-9">
                            <select class="custom-select w-100">
                                <option value=""> General Enquiry </option>
                                <option value=""> Billing Enquiry </option>
                                <option value=""> Messages Enquiry </option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <label style="color: #686868;" class="label-text col-sm-3 control-label">Body <span style="color: #ff312b;">*</span></label>

                        <div class="col-sm-9">
                            <textarea class="form-control mb-1" id="feedback" placeholder="Type your message here"></textarea>
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
                                    
    </div>
@endsection