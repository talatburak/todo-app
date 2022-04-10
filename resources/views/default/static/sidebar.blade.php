@section('sidebar')
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item {{ (strpos(Route::currentRouteName(), 'index') !== false) ? 'menu-open' : '' }}">
            <a href="{{route("index")}}" class="nav-link {{ (strpos(Route::currentRouteName(), 'index') !== false) ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Anasayfa
                </p>
            </a>
        </li>
        <li class="nav-header">Görevler</li>
            <li class="nav-item {{ (strpos(Route::currentRouteName(), 'task.create') !== false) ? 'menu-open' : '' }}">
                <a href="{{route("task.create")}}" class="nav-link {{ (strpos(Route::currentRouteName(), 'task.create') !== false) ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                    Görev Ekle
                </p>
                </a>
            </li>
            <li class="nav-item {{ (strpos(Route::currentRouteName(), 'task.index') !== false) ? 'menu-open' : '' }}">
                <a href="{{route("task.index")}}" class="nav-link {{ (strpos(Route::currentRouteName(), 'task.index') !== false) ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                    Görevlerim
                </p>
                </a>
            </li>
            <li class="nav-item {{ (strpos(Route::currentRouteName(), 'task.finished') !== false) ? 'menu-open' : '' }}">
                <a href="{{route("task.finished")}}" class="nav-link {{ (strpos(Route::currentRouteName(), 'task.finished') !== false) ? 'active' : '' }}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>
                    Bitmiş Görevler
                </p>
                </a>
            </li>
        </ul>
    </nav>
@endsection