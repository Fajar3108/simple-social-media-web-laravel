<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">PostWeb</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        @if (auth()->user())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a href="{{ url('/posts/create') }}" class="dropdown-item">Add New Post</a></li>
            <li><a class="dropdown-item btn btn-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" >Logout</a></li>
          </ul>
        </li>
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-body d-flex justify-content-between">
                <h5 class="modal-title" id="logoutModalLabel">Are you sure ?</h5>
                <div class="d-flex">
                    <button type="button" class="btn text-danger px-4" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ url('/logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
        </div>
        @else
        <li class="nav-item">
          <a class="nav-link px-4{{ request()->is('register') ? ' active' : '' }}" href="{{ url('/register') }}">Sign up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-primary px-4{{ request()->is('login') ? ' active' : '' }}" href="{{ url('/login') }}">Login</a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
