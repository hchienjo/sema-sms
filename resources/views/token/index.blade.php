@extends('layouts.dash')

@section('title', 'Api Tokens')

@section('content')
    <div class="col-md-12">
    <!--Card-->
        <div class="mask rgba-white-slight card mb-4">
            <!--Card header-->
            <div class="h6 card-header text-left">
                <span id="card_title" style="color: #0b5570; font-size: 18px;"> API Tokens </span>
            </div>
                <!--Card content-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3" style="display: flex; flex-direction: row;">
                            <span>
                                <a href="{{ route('tokens.add') }}">
                                    <button class="btn btn-primary">
                                        Add Token
                                    </button>
                                </a>
                            </span>
                            <p>
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
                                    <th class="sort-by">Token</th>
                                    <th class="sort-by">Organization</th>
                                    <th class="sort-by">Status</th>
                                    <th class="sort-by">Created At</th>
                                    <th class="sort-by">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tokens as $token)
                                    <tr>
                                        <td>
                                            {{  $token->key }}
                                        </td>
                                        <td> {{ $token->organization->companyName }}</td>
                                        <td>{{  $token->status() }}</td>
                                        <td>{{  $token->createdAt->setTimeZone('Africa/Nairobi') }}</td>
                                        <td>#</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <span>{{ $tokens->links() }}</span>
                </div>
            </form>
        </div>
    </div>
@endsection