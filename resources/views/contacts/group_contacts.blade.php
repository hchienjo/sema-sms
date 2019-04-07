@extends('layouts.dash')

@section('title', 'Contacts')

@section('content')

<div class="col-md-12">
    <div class="mask rgba-white-slight card mb-4">
        <div class="h6 card-header text-left">
            <span id="card_title" style="color: #0b5570; font-size: 18px;">{{ $contactGroup->name }} Contacts</span>
        </div>
        <div class="card-body">
            <div class="pb-3">
                <div class="row mt-3">
                </div>
                <div class="table-responsive">
                    <table class="fixed_head table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>msisdn</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                            <tr>
                                <td>
                                    <span>{{ $contact->id }}</span>
                                </td>
                                <td>
                                    <span>{{ $contact->createdAt->setTimeZone('Africa/Nairobi') }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {!! $contacts->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
