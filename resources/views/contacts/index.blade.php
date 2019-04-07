@extends('layouts.dash')

@section('title', 'Contacts')

@section('content')
    <div class="col-md-12">
        <!--Card-->
        <div class="mask rgba-white-slight card mb-4">
            <!--Card header-->
            <div class="h6 card-header text-left">
                <span id="card_title" style="color: #0b5570; font-size: 18px;"> Manage Contacts </span>
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="actions">
                                        <div class="my-auto" style="display: flex; flex-direction: row; justify-content: flex-start; vertical-align: middle;">
                                            <div>
                                            <a class="btn btn-primary" href="{{ route('contacts.add') }}">Upload Contacts</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="actions">
                                        <div class="my-auto" style="display: flex; flex-direction: row; justify-content: flex-start; vertical-align: middle;">
                                            <div>
                                            <a class="btn btn-primary" href="{{ route('contacts.groups') }}">View Contact Groups</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
