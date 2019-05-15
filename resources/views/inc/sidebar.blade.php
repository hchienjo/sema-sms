<!-- Sidebar start -->
<div style="background: #041f28;" id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('home') }}">
                <div class="icon-container p-2" style="font-size: 1.2rem; display: flex; flex-direction: row; justify-content: left; align-items: center;">
                    <span class="ti-email mt-0"></span>
                    <span class="icon-name mt-1"> New Message </span>
                </div>
            </a>
        </li>
        @auth()
            @if(Auth::user()->user_group == 1)
                <li>
                    <a href="{{ route('content.index') }}">
                        <div class="icon-container p-2" style="font-size: 1.2rem; display: flex; flex-direction: row; justify-content: left; align-items: center;">
                            <span class="ti-email mt-0"></span>
                            <span class="icon-name mt-1"> Content</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('config') }}">
                        <div class="icon-container p-2" style="font-size: 1.2rem; display: flex; flex-direction: row; justify-content: left; align-items: center;">
                            <span class="ti-settings mt-0"></span>
                            <span class="icon-name mt-1"> Configuration </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('csv.processing.jobs') }}">
                        <div class="icon-container p-2" style="font-size: 1.2rem; display: flex; flex-direction: row; justify-content: left; align-items: center;">
                            <span class="ti-arrow-up mt-0"></span>
                            <span class="icon-name mt-1"> CSV Processing Jobs </span>
                        </div>
                    </a>
                </li>
            @endif
        @endauth()
        <li>
            <a href="{{ route('scheduled') }}">
                <div class="icon-container p-2" style="font-size: 1.2rem; display: flex; flex-direction: row; justify-content: left; align-items: center;">
                    <span class="ti-pencil-alt mt-0"></span>
                    <span class="icon-name mt-1"> Scheduled Bulk</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('scheduled.custom') }}">
                <div class="icon-container p-2" style="font-size: 1.2rem; display: flex; flex-direction: row; justify-content: left; align-items: center;">
                    <span class="ti-pencil-alt mt-0"></span>
                    <span class="icon-name mt-1"> Scheduled Custom</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('bulk.outbox') }}">
                <div class="icon-container p-2" style="font-size: 1.2rem; display: flex; flex-direction: row; justify-content: left; align-items: center;">
                    <span class="ti-layers mt-0"></span>
                    <span class="icon-name mt-1"> Bulk Outbox </span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('express.outbox') }}">
                <div class="icon-container p-2" style="font-size: 1.2rem; display: flex; flex-direction: row; justify-content: left; align-items: center;">
                    <span class="ti-layout-media-right mt-0"></span>
                    <span class="icon-name mt-1"> Express Outbox </span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('api.outbox') }}">
                <div class="icon-container p-2" style="font-size: 1.2rem; display: flex; flex-direction: row; justify-content: left; align-items: center;">
                    <span class="ti-export mt-0"></span>
                    <span class="icon-name mt-1"> API Outbox </span>
                </div>
            </a>
        </li> -->
        <li>
            <a href="{{ route('contacts') }}">
                <div class="icon-container p-2" style="font-size: 1.2rem; display: flex; flex-direction: row; justify-content: left; align-items: center;">
                    <span class="ti-id-badge mt-0"></span>
                    <span class="icon-name mt-1"> Contacts </span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('billing') }}">
                <div class="icon-container p-2" style="font-size: 1.2rem; display: flex; flex-direction: row; justify-content: left; align-items: center;">
                    <span class="ti-credit-card mt-0"></span>
                    <span class="icon-name mt-1"> Billing </span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('end.session') }}">
                <div class="icon-container p-2" style="font-size: 1.2rem; display: flex; flex-direction: row; justify-content: left; align-items: center;">
                    <span class="ti-power-off mt-0"></span>
                    <span class="icon-name mt-1"> Logout </span>
                </div>
            </a>
        </li>
    </ul>
</div>
