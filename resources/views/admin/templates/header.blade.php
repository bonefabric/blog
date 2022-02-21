<div class="container-fluid bg-dark p-2">
    <div class="container d-flex justify-content-between">
        <div>
            <a href="{{ route('home') }}" class="text-white">Go to site</a>
        </div>
        <div>
            <a href="{{ route('logout') }}" class="text-white">Log out</a>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary text-white">
    <div class="container">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link{{ str_starts_with(Route::currentRouteName(), 'admin.index') ? ' active' : '' }}"
                   href="{{ route('admin.index') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ str_starts_with(Route::currentRouteName(), 'admin.users') ? ' active' : '' }}"
                   href="{{ route('admin.users') }}">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ str_starts_with(Route::currentRouteName(), 'admin.posts') ? ' active' : '' }}"
                   href="{{ route('admin.posts.index') }}">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ str_starts_with(Route::currentRouteName(), 'admin.tags') ? ' active' : '' }}"
                   href="{{ route('admin.tags.index') }}">Tags</a>
            </li>
        </ul>
        {{ Auth::check() ? Auth::user()->name : '[username]' }}
    </div>
</nav>
