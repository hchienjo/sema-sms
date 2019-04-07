<div class="col-md-12">

    <!--Card-->
    <div class="mask rgba-white-slight card mb-4">
            <!--Card content-->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3" style="display: flex; flex-direction: row;">
                        <select class="sel form-control">
                            <option>10</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                        <span class="ml-2 my-auto">records per page</span>
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
                                <th class="sort-by">Transaction</th>
                                <th class="sort-by">Date</th>
                                @if($user_group == 1)
                                    <th class="sort-by">Description</th>
                                @endif
                                <th class="sort-by">Amount</th>
                                <th class="sort-by">CreatedAt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $t)
                                <tr>
                                    <td style="color: rgb(119, 119, 119);">{{ $t->identifier }}</td>
                                    <td style="color: rgb(119, 119, 119);">{{ $t->createdAt }}</td>
                                    @if($user_group == 1)
                                        <td>{{ $t->description }}</td>
                                    @endif
                                    <td style="color: rgb(119, 119, 119);">{{ $t->value }}</td>
                                    <td style="color: rgb(119, 119, 119);">{{ $t->updatedAt }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <span class="d-flex float-left py-2" style="font-size: 0.8em">Showing 0 to 0 of 0 entries</span>
                <span class="arrows float-right mt-1 ti-angle-right rounded-right p-2" style="border-right: 1px solid #d0d4d8; border-left: 0.5px solid #d0d4d8;"></span>
                <span class="arrows float-right mt-1 ti-angle-left rounded-left p-2" style="border-left: 1px solid #d0d4d8; border-right: 0.5px solid #d0d4d8;"></span>
            </div>
            <!--Card content-->
    </div>
    <!--/.Card-->
</div>
