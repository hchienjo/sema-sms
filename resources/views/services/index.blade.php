@extends('layouts.dash')

@section('title', 'Content Services')

@section('content')

<div class="col-md-12">
    <div class="mask rgba-white-slight card mb-4">
        <div class="h6 card-header text-left">
            <span id="card_title" style="color: #0b5570; font-size: 18px;"> View Subscribable products </span>
        </div>
        <div class="card-body">
            <div class="pb-3">
                <a href="{{ route('service.add') }}">
                    <button class="btn btn-primary" id="addGroup"> Add Service <i class="fa fa-plus ml-1"></i></button>
                </a>
                <div class="row mt-3">
                </div>
                <div class="table-responsive">
                    <table class="fixed_head table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Service Name</th>
                                <th>Subscribers</th>
                                <th>Short Code</th>
                                <th>Product ID</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td>
                                <a href="{{ route('service.summary', ['productID' => $service->productID, 'serviceID' => $service->serviceNameSlug()])}}">
                                    <span>{{ $service->serviceName }}</span>
                                </a>
                            </td>
                            <th>
                                <span>{{ $service->subscribers_count }}</span>
                            </th>
                            <td>
                                <span>{{ $service->shortCode }}</span>
                            </td>
                            <td>
                                <span>{{ $service->productID }}</span>
                            </td>
                            <td>
                                <span>{{ $service->createdAt }}</span>
                            </td>
                            <td class="actions">
                                <div class="my-auto" style="display: flex; flex-direction: row; justify-content: flex-start; vertical-align: middle;">
                                    <div>
                                        <a href="{{ route('schedule.message', ['productID' => $service->productID]) }}">
                                            <button class="btn btn-primary">Schedule Messages</button>
                                        </a>
                                    </div>
                                </div>
                            </td>
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
