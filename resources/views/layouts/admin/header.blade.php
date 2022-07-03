<nav class="main-header navbar navbar-expand navbar-white navbar-light">

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <span class="badge badge-warning navbar-badge">{{auth()->user()->name}}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{auth()->user()->name}}</span>
        <div class="dropdown-divider"></div>
        <a href="{{ route('change.password') }}" class="dropdown-item">
          <i class="fas fa-envelope mr-2"></i> Change Password
        </a>
        <a class="dropdown-item" href="{{ route('admin.logout') }}">
          <i class="fa fa-power-off"></i>Logout
        </a>
        <form id="logout-form" action="{{ route('admin.logout') }}" style="display: none;">
          @csrf
        </form>
      </div>
    </li>
  </ul>
</nav>