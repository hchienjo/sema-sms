@extends('layouts.dash')

@section('title', 'Users')

@section('content')

<div class="col-md-12">
    <div class="mask rgba-white-slight card mb-4">
        <div class="h6 card-header text-left">
            <span id="card_title" style="color: #0b5570; font-size: 18px;"> View Users </span>
        </div>
        <div class="card-body">
            <div class="pb-3">
                <a href="{{ route('register') }}">
                    <button class="btn btn-primary" id="addGroup"> Add User <i class="fa fa-plus ml-1"></i></button>
                </a>
                <div class="row mt-3">
                </div>
                <div class="table-responsive">
                    <table class="fixed_head table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Organization</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <span>{{ $user->name }}</span>
                            </td>
                            <td>
                                <span>{{ $user->email }}</span>
                            </td>
                            <td>
                                <span>{{ $user->organization->companyName }}</span>
                            </td>
                            <td>
                                <span>{{ $user->status() }}</span>
                            </td>
                            <td>
                                <span>{{ $user->userGroup() }}</span>
                            </td>
                            <td>
                                <span> {{ $user->created_at }}</span>
                            </td>
                            <td class="actions">
                                <div class="my-auto" style="display: flex; flex-direction: row; justify-content: flex-start; vertical-align: middle;">
                                    <div>
                                        <button class="btn btn-primary">Edit</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
