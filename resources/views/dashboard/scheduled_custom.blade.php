@extends('layouts.dash')

@section('title', 'Scheduled Custom')

@section('content')
    <div class="col-md-12">
    <!--Card-->
    <div class="mask rgba-white-slight card mb-4">
        <!--Card header-->
        <div class="h6 card-header text-left">
            <span id="card_title" style="color: #0b5570; font-size: 18px;"> Scheduled Custom Messages </span>
        </div>

        @if(Session::has('custom'))
            @if( Session::has('processed') )
                <div class="alert alert-{{ Session::Get('success') ? 'success' : 'danger' }}" role="alert">
                    {{  Session::Get('message') }}
                </div>
            @endif
        @endif

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
                </div>
                <div class="table-responsive">
                    <table class="fixed_head table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="sort-by">Job Id</th>
                                <th class="sort-by">Date created</th>
                                <th class="sort-by">Status</th>
                                <th class="sort-by">Description</th>
                                <th class="sort-by">Processing time</th>
                                <th>View Messages</th>
                                <th>Approve</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                                <tr>
                                    <td>
                                        @if(strlen($job->identifier) > 8)
                                            <a href="{{ route('scheduled.summary', ['jobid' => $job->identifier ]) }}">
                                                {{  $job->identifier() }}
                                            </a>
                                        @else
                                            {{ $job->identifier }}
                                        @endif
                                    </td>
                                    <td>{{  $job->createdAt->setTimeZone('Africa/Nairobi') }}</td>
                                    <td>{{  $job->description }}</td>
                                    <td>{{  $job->name }}</td>
                                    <td>{{  $job->deletedAt() }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('custom.outbox', ['jobid' => $job->identifier]) }}">
                                           View Messages
                                        </a>
                                    </td>
                                    <td>
                                        @if($job->status == 1)
                                            <a class="btn btn-primary" href="{{ route('custom.approve', ['jobid' => $job->identifier]) }}">
                                                Approve
                                            </a>
                                        @elseif($job->status == 2)
                                            <button class="btn btn-success disabled">
                                                Approved
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- <span class="d-flex float-left py-2" style="font-size: 0.8em">Showing 0 to 0 of 0 entries</span> -->
                <span>{{ $jobs->links() }}</span>
            </div>
            <!--Card content-->

        </form>
    </div>
    <!--/.Card-->
    </div>
@endsection
