@if (Auth::check())
    @if (Auth::user()->role == 'Admin')
        @include('layouts.includes.sidebar')
    @else
        @include('layouts.includes.menu-tamu')
    @endif
@else
    @include('layouts.includes.menu-tamu')
@endif
