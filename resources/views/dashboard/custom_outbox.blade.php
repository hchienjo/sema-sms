@extends('layouts.dash')

@section('title', 'Custom Outbox')

@section('content')

<div class="col-md-12">
    <!--Card-->
    <div class="mask rgba-white-slight card mb-4">
        <!--Card header-->
        <div class="h6 card-header text-left">
            <span id="card_title" style="color: #0b5570; font-size: 18px;"> Custom Outbox Messages </span>
        </div>
        <!--Card header end-->
        <form>

            <!--Card content-->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3" style="display: flex; flex-direction: row;">
                        <!-- <select class="sel form-control">
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select> -->
                        <span class="ml-2 my-auto">15 records per page</span>
                    </div>
                    <div class="col-md-6 mb-3 d-flex justify-content-center align-items-center">
                        <input required class="form-control" style="border-top-right-radius: 0; border-bottom-right-radius: 0;" placeholder="Search" name="search_scheduled" type="text">
                        <span class="input-group-addon m-auto">
                            <span style="font-size: 1.55em;" class="ti-search"></span>
                        </span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="fixed_head table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="sort-by">Msisdn</th>
                                <th class="sort-by">Sms</th>
                                <th class="sort-by">Created At</th>
                                <th class="sort-by">Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($outboxes as $outbox)
                                <tr>
                                    <td>
                                        {{  $outbox->msisdn }}
                                    </td>
                                    <td>{{  $outbox->sms }}</td>
                                    <td>{{  $outbox->createdAt->setTimeZone("Africa/Nairobi") }}</td>
                                    <td>{{  $outbox->updatedAt->setTimeZone("Africa/Nairobi") }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- <span class="d-flex float-left py-2" style="font-size: 0.8em">Showing 0 to 0 of 0 entries</span> -->
                <span>{{ $outboxes->links() }}</span>
            </div>
            <!--Card content-->

        </form>
    </div>
    <!--/.Card-->
    </div>
@endsection
    