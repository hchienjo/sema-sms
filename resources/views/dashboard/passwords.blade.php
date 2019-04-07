@extends('layouts.dash')

@section('title', 'Sdp Passwords')

@section('content')
    <div class="col-md-12">

    <!--Card-->
    <div class="mask rgba-white-slight card mb-4">
        <!--Card header-->
        <div class="h6 card-header text-left">
            <span id="card_title" style="color: #0b5570; font-size: 18px;"> SDP Passwords </span>
        </div>
        <!--Card header end-->

            <!--Card content-->
            <div class="card-body">
                      <div class="pb-3">
                        <div class="row mt-3">
                        </div>
                        <div class="table-responsive">
                          <table class="fixed_head table table-hover table-bordered">
                            <thead>
                              <tr>
                                <th>spid</th>
                                <th>password</th>
                                <th>created At</th>
                                <th>updated At</th>
                                <th>expires At</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($settings as $setting)
                                <tr>
                                    <td>
                                        <span>{{ $setting->key }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $setting->value }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $setting->createdAt }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $setting->updatedAt }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $setting->updatedAt->addDays(60) }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
            </div>
            <!--Card content-->
    </div>
    <!--/.Card-->                   
</div>

@endsection
