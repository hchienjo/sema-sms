@extends('layouts.dash')

@section('title', 'Subscribers')

@section('content')

<div class="col-md-12">
    <div class="mask rgba-white-slight card mb-4">
        <div class="h6 card-header text-left">
            <span id="card_title" style="color: #0b5570; font-size: 18px;">{{ $serviceName }} Subscribers</span>
        </div>
        <div class="card-body">
            <div class="pb-3">
                <a href="{{ route('service.add') }}">
                    <a href="{{ route('service.upload', ['productID' => $productID, 'serviceName' => $serviceName]) }}">
                        <button class="btn btn-primary" id="addGroup"> Upload Subscribers <i class="fa fa-plus ml-1"></i></button>
                    </a>
                </a>
                <div class="row mt-3">
                </div>
                <div class="table-responsive">
                    <table class="fixed_head table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>msisdn</th>
                                <th>Created At</th>
                                <th>Expiry Time</th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach($subscribers as $subscriber)
                            <tr>
                                <td>
                                    <span>{{ $subscriber->msisdn }}</span>
                                </td>
                                <td>
                                    <span>{{ $subscriber->createdAt }}</span>
                                </td>
                                <td>
                                    <span>{{ $subscriber->expiryTime }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {!! $subscribers->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
