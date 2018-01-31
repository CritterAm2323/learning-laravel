<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Fixed navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item @yield('activeHome')">
              <a class="nav-link" href="/usuarios">Home</a>
            </li>
            <li class="nav-item @yield('activeNuevo')">
              <a class="nav-link" href="/usuarios/nuevo">Crear</a>
            </li>
            <li class="nav-item @yield('activeDetalles')">
              <a class="nav-link" href="/usuarios/10">Detalles</a>
            </li>
            <li class="nav-item @yield('activeEditar')">
              <a class="nav-link" href="/usuarios/10/edit">Editar</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>