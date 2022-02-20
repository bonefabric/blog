@if(auth()->user()->isAdmin())
    <div class="container-fluid bg-dark p-2">
        <div class="container">
            <a href="{{ url('admin') }}" class="text-white">Go to admin panel</a>
        </div>
    </div>
@endif
