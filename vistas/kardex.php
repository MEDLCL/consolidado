<?php
 require_once ("../inc/head.php");
 require_once ("../inc/header.php");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane container fade in active" id="home">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="razons" class="control-label col-md-2">Razon Social</label>
                                    <div class="col-md-9">
                                        <input type="hidden" name="idsucursal" id="idsucursal">
                                        <input type="text" class="form-control" id="razons" name="razons"
                                            placeholder="Razon social">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu1">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="razons" class="control-label col-md-2">Razon Social</label>
                                    <div class="col-md-9">
                                        <input type="hidden" name="idsucursal" id="idsucursal">
                                        <input type="text" class="form-control" id="razons" name="razons"
                                            placeholder="Razon social">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu2">menu2</div>
                    </div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->

</div><!-- /.content-wrapper -->
<?php
    require_once ("../inc/footer.php");
    require_once ("../inc/scritps.php");
?>