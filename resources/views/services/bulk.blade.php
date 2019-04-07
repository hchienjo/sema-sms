@extends('layouts.dash')

@section('title', 'Content Services')

@section('content')

<div class="col-md-12">
    <div class="mask rgba-white-slight card mb-4">
        <div class="h6 card-header text-left">
            <span id="card_title" style="color: #0b5570; font-size: 18px;"> View Sender Ids </span>
        </div>
        <div class="card-body">
            <div class="pb-3">
                <a href="{{ route('content.bulk.register') }}">
                    <button class="btn btn-primary" id="addGroup"> Add New SenderID <i class="fa fa-plus ml-1"></i></button>
                </a>
                <div class="row mt-3">
                </div>
                <div class="table-responsive">
                    <table class="fixed_head table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Service Name</th>
                                <th>Friendly Name</th>
                                <th>Company</th>
                                <th>Created </th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>
                                <span>{{ $service->serviceName }}</span>
                            </td>
                            <td>
                                <span>{{ $service->friendlyName }}</span>
                            </td>
                            <td>
                                <span>{{ $service->organization->companyName }}</span>
                            </td>
                            <td>
                                <span>{{ $service->createdAt->setTimeZone('Africa/Nairobi') }}</span>
                            </td>
                            <!-- <td class="actions">
                                <div class="my-auto" style="display: flex; flex-direction: row; justify-content: flex-start; vertical-align: middle;">
                                    <div>
                                        <a href="{{ route('schedule.message', ['productID' => $service->productID]) }}">
                                            <button class="btn btn-primary">Schedule Messages</button>
                                        </a>
                                    </div>
                                </div>
                            </td> -->
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {!! $services->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
