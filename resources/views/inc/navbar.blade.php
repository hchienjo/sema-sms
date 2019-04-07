<!-- Fixed navbar -->
<nav style="background: #0b3a4b; box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.2), 0 4px 10px 0 rgba(0, 0, 0, 0.19);" 
class="navbar navbar-expand-md navbar-dark fixed-top">
    <button id="menu-toggle" class="navbar-toggler hamburger hamburger--spring is-active" type="button">
      <span class="hamburger-box">
        <span class="hamburger-inner"></span>
      </span>
    </button>
    <a class="navbar-brand m-0 p-0" onclick="window.location = '/'" style="cursor: pointer;"><img class="pl-4 main_logo" src="{{ asset('images/sema.png') }}"></a>
    <ul class="navbar-nav px-3 w-100">
      <li class="nav-item m-auto row d-flex justify-content-center align-items-center">
        <span class="sys-time col-sm-6 text-center mr-0 p-0 row d-flex justify-content-center">
            <span class="text-white my-auto" style="font-size: 0.8em">System Time</span>
            <span id="clock" class="text-white my-auto pull-right m-1 p-1" style="font-weight: normal; font-size: 0.85em"> <p> @{{ time }} </p></span>
        </span>
        <span class="un-bal col-sm-6 text-center pr-0 pt-0 row d-flex justify-content-center">
            <span class="text-white my-auto" style="font-size: 0.8em">Units balance</span>
            <span id="docs_f" class="text-white my-auto pull-right m-1" style="font-size: 0.85em"> {{ Auth::user()->organization->units }} </span>
        </span>
      </li>
      <li class="nav-item">
        <div class="float-right text-white row" data-toggle="dropdown" aria-expanded="false" 
        style="cursor: pointer;">
            <span style="font-size: 1.5em" class="ti-user my-auto mr-3"></span>
            <div id="dd" class="profile pl-3" data-lock-name="CB Group" style="border-left: 1px solid #fff;">
                <span class="name" style="font-size: 0.9em">{{ Auth::user()->name }}</span><br>
                <span class="role" style="font-size: 0.9em">{{ Auth::user()->userGroup() }} | {{ Auth::user()->organization->companyName }}</span>
            </div>
        </div>
      </li>
    </ul>
</nav>
<!-- Fixed navbar end -->