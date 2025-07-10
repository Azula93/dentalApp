<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ORTODONCIA Y ORTOPEDIA MAXILAR | Dra. Diana Gomez</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
  <!-- jQuery -->
  <script src=" {{url('plugins/jquery/jquery.min.js')}}"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ url('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ url('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- FullCalendar -->
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
  <script src="{{ url('/fullcalendar/es.global.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css" />
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ url('/admin') }}" class="nav-link"><i class="fa-solid fa-house"></i> Inicio</a>
        </li>
      </ul>
    </nav>

    <!-- 
    <!- Main Sidebar Container -->
    <
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{url('/admin')}}" class="brand-link">
        <img src="{{url('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dra. Diana G</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <!-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
          <div class="info">
            <a href="#" class="d-block"> <b>Tipo de cuenta:</b> {{ Auth::user()->roles->pluck('name')->first() }}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <!-- Configuraciones -->
            @can('admin.usuarios.index')
            <li class="nav-item ">
              <a href="{{url('/admin/configs')}}" class="nav-link active"
                style="background-color: rgb(108, 117, 125);">
                <i class=" nav-icon fas fa-solid fa-gear"></i>
                <p>
                  Configuración
                </p>
              </a>
            </li>
            @endcan
            <!-- /configuraciones -->

            <!-- usuarios -->
            @can('admin.usuarios.index')
            <li class="nav-item ">
              <a href="{{url('admin/usuarios/create')}}" class="nav-link active"
                style="background-color: rgb(111, 66, 193);">
                <i class="nav-icon fas fa-solid fa-users"></i>
                <p>
                  Usuarios
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/usuarios/create')}}" class="nav-link">
                    <i class="nav-icon fas fa-solid fa-user-plus"></i>
                    <p> Crear Usuario</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/usuarios')}} " class="nav-link">
                    <i class="nav-icon fas fa-solid fa-list-check"></i>
                    <p> Lista de usuarios</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan
            <!-- /usuarios -->

            <!-- Auxiliar administrativos -->
            @can('admin.secretarias.index')
            <li class="nav-item ">
              <a href="{{url('admin/secretarias/create')}}" class="nav-link active 
              ">
                <i class="nav-icon fas fa-solid fa-user-nurse"></i>
                <p>
                  Auxiliar admin
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/secretarias/create')}}" class="nav-link ">
                    <i class="nav-icon fas fa-solid fa-user-plus"></i>
                    <p> Agregar Auxiliar administrativo</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/secretarias')}} " class="nav-link">
                    <i class="nav-icon fas fa-solid fa-list-check"></i>
                    <p>Lista de Auxiliar administrativos</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- /Auxiliar administrativos -->
            @endcan

            <!-- pacientes -->
            @can('admin.pacientes.index')
            <li class="nav-item ">
              <a href="{{url('admin/pacientes/create')}}" class="nav-link active bg-success">
                <i class="nav-icon fas fa-solid fa-hospital-user"></i>
                <p>
                  Pacientes
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @hasanyrole('admin|colaborador')
                <li class="nav-item">
                  <a href="{{url('admin/pacientes/create')}}" class="nav-link ">
                    <i class="nav-icon fas fa-solid fa-user-plus"></i>
                    <p> Agregar Paciente</p>
                  </a>
                </li>
                @endhasanyrole
                <li class="nav-item">
                  <a href="{{url('admin/pacientes')}} " class="nav-link">
                    <i class="nav-icon fas fa-solid fa-list-check"></i>
                    <p>Lista de pacientes</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{url('admin/pacientes/controles')}}" class=" nav-link">
                    <i class="nav-icon fas fa-solid fa-tooth"></i>
                    <p>Controles</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{url('admin/pacientes/buscar_paciente')}}" class=" nav-link">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <p>Buscar Paciente</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan
            <!-- /pacientes -->


            <!-- consultorios -->
            @can('admin.consultorios.index')
            <li class="nav-item ">
              <a href="{{url('admin/consultorios/create')}}" class="nav-link active bg-warning">
                <i class="nav-icon fas fa-solid fa-house-medical"></i>
                <p>
                  Consultorios
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/consultorios/create')}}" class="nav-link ">
                    <i class="nav-icon fas fa-solid fa-plus"></i>
                    <p> Agregar Consultorio</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/consultorios')}} " class="nav-link">
                    <i class="nav-icon fas fa-solid fa-list-check"></i>
                    <p>Lista de consultorios</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan
            <!-- /consultorios -->

            <!-- doctores -->
            @can('admin.doctores.index')
            <li class="nav-item ">
              <a href="{{url('admin/doctores/create')}}" class="nav-link active bg-danger">
                <i class="nav-icon fas fa-solid fa-tooth"></i>
                <p>
                  Doctores
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/doctores/create')}}" class="nav-link ">
                    <i class="nav-icon fas fa-solid fa-user-plus"></i>
                    <p> Agregar Doctor</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{url('admin/doctores')}} " class="nav-link">
                    <i class="nav-icon fas fa-solid fa-list-check"></i>
                    <p>Lista de doctores</p>
                  </a>
                </li>

                <!-- <li class="nav-item">
                  <a href="{{url('admin/doctores/reportes')}} " class="nav-link">
                    <i class="nav-icon fas fa-solid fa-file-pdf"></i>
                    <p>Reportes</p>
                  </a>
                </li> -->
              </ul>
            </li>
            @endcan
            <!-- /doctores -->

            <!-- horarios -->
            @can('admin.horarios.index')
            <li class="nav-item ">
              <a href="{{url('admin/horarios/create')}}" class="nav-link active " style=" background-color: rgb(99, 153, 204)">
                <i class="nav-icon fas fa-solid fa-calendar-days"></i>
                <p>
                  Horarios
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/horarios/create')}}" class="nav-link ">
                    <i class="nav-icon fas fa-solid fa-calendar-plus"></i>
                    <p>Crear horario</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/horarios')}} " class="nav-link">
                    <i class="nav-icon fas fa-solid fa-list-check"></i>
                    <p>Lista de horarios</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan
            <!-- /horarios -->

            <!-- reservas -->
            @can('admin.usuarios.index')
            <li class="nav-item ">
              <a href="{{url('admin/doctores/create')}}" class="nav-link active " style=" background-color: rgb(232, 62, 140)" ;>
                <i class="nav-icon fas fa-solid fa-handshake-angle"></i>
                <p>
                  Reservas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/reservas/reportes')}} " class="nav-link">
                    <i class="nav-icon fas fa-solid fa-file-pdf"></i>
                    <p>Reportes</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan
            <!-- /reservas -->

            <!-- facturacion -->
            @can('admin.facturacion.index')
            <li class="nav-item ">
              <a href="{{url('admin/facturacion/create')}}" class="nav-link active " style=" background-color: rgb(20, 155, 168)" ;>
                <i class="nav-icon fas fa-solid fa-dollar-sign"></i>
                <p>
                  Facturación
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/facturacion')}} " class="nav-link">
                    <i class="nav-icon fas fa-solid fa-file-pdf"></i>
                    <p>Facturas</p>
                  </a>
                </li>
              </ul>
            </li>
            @endcan
            <!-- /facturacion -->



            <!-- CERRAR SESION   -->
            <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link" style="background-color:rgb(175, 62, 27);"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-solid fa-right-from-bracket"></i>
                <p>
                  Cerrar Sesión
                </p>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
            <!-- /CERRAR SESION   -->
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->

      </aside>

      @if (($message=Session::get('mensaje')) && ($icono=Session::get('icono')))
      <script>
        Swal.fire({
          position: "center",
          icon: "{{ $icono }}",
          title: "{{ $message }}",
          showConfirmButton: false,
          timer: 3000
        });
      </script>
      @endif



      <div class="content-wrapper">
        <div class="container">
          @yield('content')
        </div>
      </div>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
          Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2025 <a href="#">AzulaDev</a>.</strong> All rights reserved.
      </footer>
  </div>

  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- Bootstrap 4 -->
  <script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{url('dist/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{url('https://kit.fontawesome.com/52b9ec387c.js')}}" crossorigin="anonymous"></script>
  <!-- DataTables & Plugins -->
  <script src="{{ url('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ url('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ url('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ url('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ url('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ url('/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ url('/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ url('/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ url('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ url('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ url('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

  <!-- Sweetalert -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
  @stack('scripts')
</body>

</html>