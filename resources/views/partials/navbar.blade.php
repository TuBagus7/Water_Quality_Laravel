<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/dashboard">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/devices">Device</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/sensors">Sensor</a>
                </li>
                {{-- @if (auth()->check())
                @endif --}}
                @auth
                <li class="nav-item">
                    <form action="/logout" method="post">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-sm btn-danger">
                            Log Out
                        </button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
