<header class="main-header btn-primary">
    <!-- Logo -->
    <a href="<?php echo base_url("menu");?>" class="logo">
      <img src="<?php echo  site_url(); ?>/assets/img/logo-progestion2.png">
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
   <!--      <span class="icon-bar">ddd</span>
        <span class="icon-bar">ddd</span>
        <span class="icon-bar">dd</span> -->
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown user user-menu">
            <a class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs titulo"><?php echo $nombre;?></span>
            </a>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="<?php echo base_url("login");?>" class="btn btn-primary">Salir</a>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <!-- <li class="dropdown user user-menu">
           
              
            </a>
            
            <ul class="dropdown-menu">
              <!-- User image
              <li class="user-header">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $nombre;?> - "Cargo"
                  <small>FechaNacimientoOActual</small>
                </p>
              </li>
              <!-- Menu Body 
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Tareas</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Pendientes</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Atrazadas</a>
                  </div>
                </div>
                <!-- /.row 
              </li>
              <!-- Menu Footer
              <li class="user-footer">
                  <div class="pull-right">
                  <a href="<?php echo base_url("login");?>" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li> -->
          <!-- Control Sidebar Toggle Button -->
          </div>
    </nav>
  </header>
