 <nav class="main-header navbar navbar-expand sticky-top navbar-info navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

       <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle user-panel">
                     <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    {{ Auth::user()->name }}
                </a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                    <li><router-link to="/setting" class="dropdown-item">Setting</router-link></li>
                  <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    Déconnexion
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </li>
                </ul>
        </li>
    </ul>

    <!-- SEARCH FORM -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>

    </ul>
  </nav>
