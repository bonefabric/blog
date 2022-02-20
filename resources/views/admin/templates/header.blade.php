<div class="container-fluid bg-dark p-2">
    <div class="container d-flex justify-content-between">
        <div>
            <a href="{{ url('/') }}" class="text-white">Go to site</a>
        </div>
        <div>
            <a href="{{ url('logout') }}" class="text-white">Log out</a>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary text-white">
    <div class="container">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link{{ str_starts_with(Route::currentRouteName(), 'admin.tags') ? ' active' : '' }}" href="{{ url('admin/tags') }}">Tags</a>
            </li>
        </ul>
        [username]
    </div>
</nav>
