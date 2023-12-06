<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">News App :)</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="/">Inicio</a>
          </li>
          @guest
            <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/registro">Registro</a>
            </li>
          @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('noticias.index') }}">Dashboard</a>
            </li>
            <li class="nav-item">
                <form style="display: inline" action="/logout" method="POST">
                    @csrf
                    <a class="nav-link" href="#" onclick="this.closest('form').submit()">Logout</a>
                </form>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
