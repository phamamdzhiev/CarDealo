<h1>CarDealo Admin</h1>

<header>
    <ul>
        <li><a href="{{ route('admin.listings') }}">Listings</a></li>
        <li><a href="{{ route('admin.users') }}">Users</a></li>
    </ul>
</header>


<main>
    @yield('main')

</main>
