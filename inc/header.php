<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="../logos/<?php echo $_SESSION['logo'];  ?>" alt="logo" height="50px"> </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>SERCOGUA</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- aqui va el menu de notificaciones y correos -->
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../img/avatar/<?php echo $_SESSION['avatar']; ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="../img/avatar/<?php echo $_SESSION['avatar']; ?>" class="img-circle" alt="User Image">
                                    <p>
                                        <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido']; ?>
                                        <small><?php echo $_SESSION['correo'];  ?></small>
                                    </p>
                                </li>

                            </ul>
                        </li>
                        <li><a href="../ajax/login.php?op=salir"><i class='fa fa-close'></i> Salir</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="../img/avatar/ <?php echo $_SESSION['avatar']; ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellido']; ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Menu Principal</li>

                    <?php if ($_SESSION['Registros'] == 1) : ?>

                        <li class=" treeview">
                            <a href="#">
                                <i class="fa fa-archive"></i> <span>Registros</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="active treeview-menu">

                                <?php if ($_SESSION['AgenteE'] == 1) : ?>
                                    <li class=""><a href="empresas.php?tipo=agentee"><i class="fa fa-building"></i> Agente
                                            Embarcador</a></li>
                                <?php endif; ?>
                                <?php if ($_SESSION['AgenciaC'] == 1) :  ?>
                                    <li><a href="empresas.php?tipo=agenciac"><i class="fa fa-building"></i> Agencia de Carga</a>
                                    </li>
                                <?php endif; ?>
                                <?php if ($_SESSION['Aéreo-linea'] == 1) : ?>
                                    <li><a href="empresas.php?tipo=aereolinea"><i class="fa fa-building"></i>Aereo-Linea</a></li>
                                <?php endif; ?>
                                <?php if ($_SESSION['Almacenadora'] == 1) : ?>
                                    <li><a href="empresas.php?tipo=almacen"><i class="fa fa-building"></i>Almacenadora</a></li>
                                <?php endif; ?>
                                <?php if ($_SESSION['Consignatario'] == 1) : ?>
                                    <li><a href="empresas.php?tipo=cliente"><i class="fa fa-building"></i>Consignatario</a></li>
                                <?php endif; ?>
                                <?php if ($_SESSION['Consignado'] == 1) : ?>
                                    <li><a href="empresas.php?tipo=consignado"><i class="fa fa-building"></i>Consignado</a></li>
                                <?php endif; ?>
                                <?php if ($_SESSION['Embarcador'] == 1) : ?>
                                    <li><a href="empresas.php?tipo=embarcador"><i class="fa fa-building"></i>Embarcador</a></li>
                                <?php endif; ?>
                                <?php if ($_SESSION['Naviera'] == 1) : ?>
                                    <li><a href="empresas.php?tipo=naviera"><i class="fa fa-building"></i>Naviera</a></li>
                                <?php endif; ?>
                                <?php if ($_SESSION['Proveedor'] == 1) : ?>
                                    <li><a href="empresas.php?tipo=proveedor"><i class="fa fa-building"></i>Proveedor</a></li>
                                <?php endif; ?>
                                <?php if ($_SESSION['Transportista'] == 1) : ?>
                                    <li><a href="empresas.php?tipo=transporte"><i class="fa fa-building"></i>Transportista</a></li>
                                <?php endif; ?>

                            </ul>
                        </li> <!--  registros  -->
                    <?php endif; ?>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Ventas</span>
                            <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a>
                            </li>
                            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                            <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed
                                    Sidebar</a></li>
                        </ul>
                    </li>
                    <li class='treeview'>
                        <a href="#">
                            <i class="fa fa-ship"></i><i class="fa fa-plane"></i><i class="fa fa-truck"></i> 
                            <span>Operaciones</span>
                            <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class='treeview-menu'>
                            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                            <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa  fa-users"></i>
                            <span>Servicio al Cliente</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                            <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-usd"></i>
                            <span>Cobros</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-usd"></i> <span>Pagos</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a>
                            </li>
                            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a>
                            </li>
                            <li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-money"></i> <span>Bancos</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="pages/calendar.html">
                            <i class="fa fa-square"></i> <span>Almacen</span>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-red">3</small>
                                <small class="label pull-right bg-blue">17</small>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="pages/mailbox/mailbox.html">
                            <i class="fa fa-envelope"></i> <span>Recepciòn</span>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-yellow">12</small>
                                <small class="label pull-right bg-green">16</small>
                                <small class="label pull-right bg-red">5</small>
                            </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-user"></i> <span>RRHH</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                            <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
                            <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                            <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                            <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a>
                            </li>
                            <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                            <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                            <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                            <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cogs"></i> <span>Administracion</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="usuario.php"><i class="fa fa-user"></i>Usuarios</a></li>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-circle-o"></i> Level One
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-circle-o"></i> Level Two
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="vistasucursal.php"><i class="fa fa-institution"></i>Sucursal</a></li>
                        </ul>
                    </li>

                    <!-- <li class="header">LABELS</li>
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>