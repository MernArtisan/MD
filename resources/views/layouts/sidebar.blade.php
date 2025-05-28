<div class="main-nav">
            <!-- Sidebar Logo -->
            <div class="logo-box">
                <a href="{{route('property')}}" class="logo-dark">
                    <img src="{{asset('admin/assets/images/md-logo.png')}}" class="logo-sm" alt="md-logo">
                    <img src="{{asset('admin/assets/images/md-logo.png')}}" class="logo-lg" alt="md-logo">
                </a>

                <a href="{{route('property')}}" class="logo-light">
                    <img src="{{asset('admin/assets/images/md-logo.png')}}" class="logo-sm" alt="md-logo">
                    <img src="{{asset('admin/assets/images/md-logo.png')}}" class="logo-lg" alt="md-logo">
                </a>
            </div>
<style>
    ul.nav.sub-navbar-nav.my-nav-item {

    overflow: hidden;
}
 
</style>
            <!-- Menu Toggle Button (sm-hover) -->
            <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
                <i class="ri-menu-2-line fs-24 button-sm-hover-icon"></i>
            </button>

            <div class="scrollbar" data-simplebar>

                <ul class="navbar-nav" id="navbar-nav">

                    <li class="nav-item">
                        
                        <ul class="nav sub-navbar-nav my-nav-item">
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{route('property')}}">My Property</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{route('list')}}">List Property</a>
                            </li>
                            <li class="sub-nav-item">
                                {{-- <a class="sub-nav-link" href="{{route('details')}}">Property Details</a> --}}
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{route('show_add_form')}}">Add Property</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{route('report')}}">Management Reports</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{route('discount')}}">Property Discounts</a>
                            </li>
                            <li class="sub-nav-item">
                                <a class="sub-nav-link" href="{{route('calender')}}">Calender Slots</a>
                            </li>
                        </ul>
                        <!--   </div> -->
                    </li> <!-- end Pages Menu -->
                </ul>
            </div>
        </div>