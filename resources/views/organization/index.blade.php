@extends('layouts.dash')

@section('title', 'Organizations')

@section('content')
    <div class="col-md-12">
    <!--Card-->
        <div class="mask rgba-white-slight card mb-4">
            <!--Card header-->
            <div class="h6 card-header text-left">
                <span id="card_title" style="color: #0b5570; font-size: 18px;"> Companies Registered </span>
            </div>
                <!--Card content-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3" style="display: flex; flex-direction: row;">
                            <span>
                                <a href="{{ route('companies.add') }}">
                                    <button class="btn btn-primary">
                                        Add Company
                                    </button>
                                </a>
                            </span>
                            <p>|</p>
                            <span>
                                <a href="{{ route('companies.topup') }}">
                                    <button class="btn btn-primary">
                                        Add Units
                                    </button>
                                </a>
                            </span>
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
                                    <th class="sort-by">Name</th>
                                    <th class="sort-by">Type</th>
                                    <th class="sort-by">Status</th>
                                    <th class="sort-by">Units</th>
                                    <th class="sort-by">Created At</th>
                                    <th class="sort-by">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orgs as $org)
                                    <tr>
                                        <td>
                                            {{  $org->companyName }}
                                        </td>
                                        <td>{{  $org->type() }}</td>
                                        <td>{{  $org->status() }}</td>
                                        <td>{{ $org->units }}</td>
                                        <td>{{  $org->createdAt->setTimeZone('Africa/Nairobi') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <span>{{ $orgs->links() }}</span>
                </div>
            </form>
        </div>
    </div>
@endsection