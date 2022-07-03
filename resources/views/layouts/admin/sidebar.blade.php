<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <a href="index3.html" class="brand-link">
    <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <span class="brand-text font-weight-light">Drishti Sanchar</span>
  </a>

  <div class="sidebar">

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if(auth()->user()->is_admin)
        <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link">
            <i class="nav-icon fas fa-igloo"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @endif
        @if(auth()->user()->is_admin==0)
        <li class="nav-item">
          <a href="{{route('customer-dashboard')}}" class="nav-link">
            <i class="nav-icon fas fa-igloo"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>
              News Articles
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('news-create')
            <li class="nav-item">
              <a href="{{route('news.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add News </p>
              </a>
            </li>
            @endcan
            <li class="nav-item">
              <a href="{{route('news.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>All News</p>
              </a>
            </li>
          </ul>
        </li>
        @can('users-list')
        <li class="nav-item">
          <a href="{{route('category.index')}}" class="nav-link">
            <i class="nav-icon fas fa-certificate"></i>
            <p>
              All Categories
            </p>
          </a>
        </li>
        @endcan
        @can('users-list')
        <li class="nav-item">
          <a href="{{route('users.index')}}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              All Users
            </p>
          </a>
        </li>
        @endcan
        @if(auth()->user()->is_admin)
        <li class="nav-item">
          <a href="{{route('settings.edit',1)}}" class="nav-link">
            <i class="nav-icon fas fa-igloo"></i>
            <p>
              Setting
            </p>
          </a>
        </li>
        @endif
      </ul>
    </nav>

  </div>

</aside>