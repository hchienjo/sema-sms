<div class="col-md-12">
    <!--Card-->
    <div class="mask rgba-white-slight card mb-4">
        <!--Card header-->
        <div class="h6 card-header text-left">
            <span id="card_title" style="color: #0b5570; font-size: 18px;"> Bulk Outbox </span>
        </div>
        <!--Card header end-->
            <!--Card content-->
        <div class="card-body">
            <div class="table-responsive">
                <table class="fixed_head table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="sort-by">Message Id</th>
                            <th class="sort-by">Date created</th>
                            <th class="sort-by">Recipient</th>
                            <th class="sort-by">Message</th>
                            <th class="sort-by">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($outboxes as $out)
                            <tr>
                                <td> {{ $out->id }}</td>
                                <td> {{ $out->createdAt->setTimeZone('Africa/Nairobi') }}</td>
                                <td> {{ $out->msisdn }}</td>
                                <td> {{ $out->sms }}</td>
                                <td> {{ $out->deliveryStatus }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <span>{{ $outboxes->links() }}</span>
        </div>
    </div>
