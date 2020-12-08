<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SERCOGUA | ALMADISA</title>

    <link rel="shortcut icon" href="../img/logo2.jfif" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../plantilla/bootstrap/css/bootstrap.min.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plantilla/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="../plantilla/bower_components/Ionicons/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="../plantilla/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../plantilla/css/_all-skins.min.css">
    <!--DATATABLES -->

    <link rel="stylesheet" href="../plantilla/datatables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../plantilla/datatables/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../plantilla/datatables/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="../plantilla/plugins/bootstrap-selected/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../estilos/style.css">
    <link rel="stylesheet" href="../plantilla/plugins/alertify/alertify.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="login-box">
        <div class="login-logo">
            <img src="../img/logo2.jfif" alt="logo" class="logo2">
        </div><!-- /.login-logo -->

        <div class="login-box-body">
            <p class="login-box-msg">Ingrese sus datos de Acceso</p>

            <form method="post" id="frmAcceso" action="">
                <div class="form-group has-feedback">
                    <input type="text" id="logina" name="logina" class="form-control" placeholder="Usuario">

                    <span class="fa fa-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" id="clavea" name="clavea" class="form-control" placeholder="Password"
                        autocomplete="FALSE">
                    <span class="fa fa-key form-control-feedback"></span>
                </div>   
                <div class="row">
                    <div class="col-xs-8">

                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                    </div><!-- /.col -->
                </div>
            </form>
            <a href="#">Olvidé mi password</a><br>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <!-- jQuery 3 -->
    <script type="text/javascript" src="../plantilla/js/jquery-3.1.1.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="../plantilla/js/bootstrap.min.js"></script>

    <!-- Bootstrap WYSIHTML5 -->
    <!-- <script src="../plantilla/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
    <!-- Slimscroll -->
    <!-- <script src="../plantilla/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script> -->

    <script type="text/javascript" src="../plantilla/js/adminlte.min.js"></script><!-- AdminLTE App -->

    <!--dataTables-->
    <script src="../plantilla/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../plantilla/datatables/js/dataTables.buttons.min.js"></script>
    <script src="../plantilla/datatables/js/buttons.html5.min.js"></script>
    <script src="../plantilla/datatables/js/buttons.colVis.min.js"></script>
    <script src="../plantilla/datatables/js/jszip.min.js"></script>
    <script src="../plantilla/datatables/js/pdfmake.min.js"></script>
    <script src="../plantilla/datatables/js/vfs_fonts.js"></script>
    <script src="../plantilla/js/bootbox.min.js"></script>
    <script src="../plantilla/plugins/bootstrap-selected/js/bootstrap-select.min.js"></script>
    <script src="../plantilla/plugins/alertify/alertify.js"></script>
</body>

</html>