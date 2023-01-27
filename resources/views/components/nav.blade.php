<nav class="d-flex justify-content-between navbar navbar-expand-lg px-3 py-3 mb-0 fs-5 fw-bold">
    
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars txt-CW yellowHover"></i>
    </button>
    
    <div class="col-4 d-lg-flex d-none justify-content-start">
        @guest
        <a class="txt-CW px-lg-1 py-1 py-lg-0 nav-link yellowHover" href="{{route('login')}}">{{__('ui.sell')}} <i class="fa-solid fa-truck-fast"></i></a>
        @else
        <a class="txt-CW px-lg-1 py-1 py-lg-0 nav-link yellowHover" href="{{route('createInsertion')}}">{{__('ui.sell')}} <i class="fa-solid fa-truck-fast"></i></a>
        @endguest
        <div class="dropdown">
            <a class="txt-CW px-lg-1 py-1 py-lg-0 nav-link yellowHover" data-bs-toggle="dropdown" aria-expanded="false">
                {{__('ui.buy')}} <i class="fa-solid fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdownBackground">
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Games'])}}">{{__('ui.Games')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Sport'])}}">{{__('ui.Sport')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Clothing'])}}">{{__('ui.Clothing')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Homeliving'])}}">{{__('ui.Homeliving')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Elettronics'])}}">{{__('ui.Elettronics')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Jewelry'])}}">{{__('ui.Jewelry')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Computers & other'])}}">{{__('ui.Computers & other')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Books'])}}">{{__('ui.Books')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Videogames'])}}">{{__('ui.Videogames')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Music'])}}">{{__('ui.Music')}}</a></li>
            </ul>
        </div>
    </div>
    
    <div class="col col-md-4 d-flex justify-content-center">
        <a class="nav-link txt-CY" href="/"><h2 class="fw-bold fst-italic">PRESTO! <i class="fa-brands fa-opencart"></i></h2></a>
    </div>
    @guest
    <button class="navbar-toggler border-0 position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-user-gear txt-CW yellowHover"></i>
    </button>
    @else
    @if (Auth::user()->is_revisor)
    <button class="navbar-toggler border-0 position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-user-gear txt-CW yellowHover"></i>
        
        
        @php
        $insertions = \App\Models\Insertion::get();
        $counter = 0;
        @endphp
        @foreach ($insertions as $insertion)
        @if ($insertion->is_accepted === null)
        @php
        $counter++    
        @endphp
        @endif
        @endforeach
        
        
        @if ($counter != 0)
        <span class="position-absolute translate-middle badge rounded-pill">
            {{$counter}}
        </span>
        
        @endif
    </button>
    @else
    <button class="navbar-toggler border-0 position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-user-gear txt-CW yellowHover"></i>
    </button>
    @endif
    @endguest
    <div class="col-4 offcanvas offcanvas-end txt-CW bg-CB" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
        <div class="offcanvas-body d-lg-flex justify-content-lg-end">
            <div class="d-flex justify-content-end">
                <a type="button" class="d-lg-none" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark txt-CW yellowHover"></i></a>                
            </div>
            @guest
            <div class="d-flex">
                <a class="nav-link txt-CW yellowHover" href="{{route('register')}}">{{__('ui.register')}} <i class="fa-solid fa-address-card"></i></a>
                <a class="ps-lg-3 nav-link txt-CW ms-2 ms-lg-0 yellowHover" href="{{route('login')}}">{{__('ui.login')}} <i class="fa-solid fa-right-to-bracket"></i></a>            
            </div>
            @else
            <div class="dropdown">
                <a class="ps-lg-3 nav-link txt-CW offcanvasLinkSize yellowHover" data-bs-toggle="dropdown" aria-expanded="false">{{__('ui.welcome')}} {{Auth::user()->name}} 
                    @if (Auth::user()->picPath != null)
                    <img class="avatarNav" src="{{URL('storage') . '/' . Auth::user()->picPath}}" alt="No img">
                    @endif
                    <i class="fa-solid fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-end dropdownBackground">
                    <li><a class="dropdown-item txt-CB" href="{{route('profilePage')}}">{{__('ui.profile')}} <i class="fa-solid fa-user"></i></a></li>
                    <li>                        
                        @if (Auth::user()->is_revisor)
                        <a class="dropdown-item txt-CB" href="{{route('revisionPage')}}" id="toBeReviewed">{{__('ui.RI')}}  <i class="fa-solid fa-screwdriver-wrench"></i>
                            @php
                            $insertions = \App\Models\Insertion::get();
                            $counter = 0;
                            @endphp
                            @foreach ($insertions as $insertion)
                            @if ($insertion->is_accepted === null)
                            @php
                            $counter++    
                            @endphp
                            @endif
                            @endforeach
                            @if ($counter != 0)
                            <span class="translate-middle badge rounded-pill">
                                {{$counter}}
                            </span>
                            @endif
                        </a>
                        
                        @else
                        <a class="dropdown-item txt-CB" href="{{route('workWithUs')}}">{{__('ui.WWU')}}  <i class="fa-solid fa-people-group"></i></a>  
                        @endif
                    </li>
                    <li><a class="dropdown-item txt-CB" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout <i class="fa-solid fa-right-from-bracket"></i></a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            
            @endguest
        </div>
    </div>
    
    {{-- <div class="navbar-nav col-4 d-none d-lg-flex justify-content-end">
        @guest
        <div class="d-flex">
            <a class="nav-link txt-CW" href="{{route('register')}}">{{__('ui.register')}} <i class="fa-solid fa-address-card"></i></a>
            <a class="nav-link txt-CW ms-2 ms-lg-0" href="{{route('login')}}">{{__('ui.login')}} <i class="fa-solid fa-user"></i></a>            
        </div>
        @else
        <a class="nav-link txt-CW" href="{{route('profilePage')}}">{{__('ui.welcome')}} {{Auth::user()->name}}</a>
        @if (Auth::user()->is_revisor)
        <a class="nav-link txt-CW" href="{{route('revisionPage')}}">{{__('ui.RI')}}  <i class="fa-solid fa-screwdriver-wrench"></i></a>          
        @else
        <a class="nav-link txt-CW" href="{{route('workWithUs')}}">{{__('ui.WWU')}}  </a>  
        @endif
        <a class="nav-link txt-CW" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{route('logout')}}" method="POST" class="d-none">
            @csrf
        </form>
        @endguest
    </div> --}}
    
    <div class="col-4 justify-content-end collapse navbar-collapse-custom" id="navbarNavDropdown">
        @guest
        <a class="txt-CW px-lg-1 py-1 py-lg-0 nav-link yellowHover" href="{{route('login')}}">{{__('ui.sell')}} <i class="fa-solid fa-handshake"></i></a>
        @else
        <a class="txt-CW px-lg-1 py-1 py-lg-0 nav-link yellowHover" href="{{route('createInsertion')}}">{{__('ui.sell')}} <i class="fa-solid fa-handshake"></i></a>
        @endguest
        <div class="dropdown">
            <a class="txt-CW px-lg-1 py-1 py-lg-0 nav-link yellowHover" data-bs-toggle="dropdown" aria-expanded="false">
                {{__('ui.buy')}} <i class="fa-solid fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end dropdownBackground">
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Games'])}}">{{__('ui.Games')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Sport'])}}">{{__('ui.Sport')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Clothing'])}}">{{__('ui.Clothing')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Homeliving'])}}">{{__('ui.Homeliving')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Elettronics'])}}">{{__('ui.Elettronics')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Jewelry'])}}">{{__('ui.Jewelry')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Computers & other'])}}">{{__('ui.Computers & other')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Books'])}}">{{__('ui.Books')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Videogames'])}}">{{__('ui.Videogames')}}</a></li>
                <li><a class="dropdown-item txt-CB" href="{{route('showInsertions', ['Music'])}}">{{__('ui.Music')}}</a></li>
            </ul>
        </div>
    </div>
</nav>