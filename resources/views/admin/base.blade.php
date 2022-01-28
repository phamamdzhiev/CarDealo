<h1>{{ env('APP_NAME') }} Admin</h1>

<header>
    <ul>
        <li><a href="{{ route('admin.listings') }}">Listings</a></li>
        <li><a href="{{ route('admin.users') }}">Users</a></li>
        <li><a style="color: red" href="{{ route('admin.logout') }}">LOGOUT</a></li>
    </ul>
</header>


<main>
    @yield('main')

</main>
