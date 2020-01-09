<!-- Brand Logo -->
<a href="" class="brand-link">
  <span class="brand-text font-weight-light">CONTROLTEC</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

      <li class="nav-item">
        <a href="/" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Home
          </p>
        </a>
      </li>
      <li class="nav-item has-treeview">
        <a href="/clientes" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Clientes
          </p>
        </a>
      </li>
      <li class="nav-item has-treeview">
        <a href="/ordens" class="nav-link">
          <i class="nav-icon fas fa-copy"></i>
          <p>
            Ordens de Serviço
          </p>
        </a>
      </li>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Funcionarios
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="/tecnicos" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Tecnicos</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/auxiliares" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Auxiliares</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item has-treeview">
        <a href="/servicos" class="nav-link">
          <i class="nav-icon fas fa-tree"></i>
          <p>
            Serviços
          </p>
        </a>
      </li>
      <li class="nav-item has-treeview">
        <a href="/equipamentos" class="nav-link">
          <i class="nav-icon far fa-plus-square"></i>
          <p>
            Equipamentos
            <!--i class="fas fa-angle-left right"></i-->
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/metas" class="nav-link" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Metas
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/status" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Status
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/users" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Usuarios
          </p>
        </a>
      </li>
      <br>
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            {{ Auth::user()->name }}
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              <i class="far fa-circle nav-icon"></i>
              <p>Sair</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
            </form>
          </li>
          <li class="nav-item">
            <a href="/log" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
              <p>Logs do Sistema</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://mega.nz/#!G0ZQlYaA!JhfIKYrU79JsrysjipnybSFQy0U4bVd5ocOFbC-KXYc" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
              <p>Manual do Sistema</p>
            </a>
          </li>
        </ul>

  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->