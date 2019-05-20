<div class="app-sidebar__user"><img class="app-sidebar__user-avatar"src="@if (isset(Auth::user()->picture)){{asset(Auth::user()->picture)}} @else {{asset('images/avatar128.png')}} @endif" alt="User Image">
    <div>
        <p class="app-sidebar__user-name">{{Auth::user()->name}}</p>
        <p class="app-sidebar__user-designation">{{Auth::user()->role->name}}</p>
    </div>
</div>
@php
    $role = Auth::user()->role->name;
@endphp
<ul class="app-menu">
    @if ($role == "Admin")
        <li><a class="app-menu__item @if($current_page == 'dashboard') active @endif" href="{{route('admin.dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li><a class="app-menu__item @if($current_page == 'user') active @endif" href="{{route('user.index')}}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">User Management</span></a></li>
    @endif

    @if ($role == "Consultant")
        <li><a class="app-menu__item @if($current_page == 'dashboard') active @endif" href="{{route('consultant.dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
    @endif

    @if ($role == "User")
        <li><a class="app-menu__item @if($current_page == 'dashboard') active @endif" href="{{route('user.dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">New Question</span></a></li>
        <li><a class="app-menu__item @if($current_page == 'question') active @endif" href="{{route('user.question')}}"><i class="app-menu__icon fa fa-question-circle"></i><span class="app-menu__label">My Questions</span></a></li>
    @endif
</ul>