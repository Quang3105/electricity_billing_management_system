<?php 
    require_once('head_html.php'); 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php'); 
    require_once('../Includes/admin.php'); 
    if ($logged==false) {
         header("Location:../index.php");
    }
    elseif ($_SESSION['account'] != 0 and $_SESSION['account'] != 1) {
        header("Location:../index.php");
    }
?>

<body>

    <div id="wrapper">
    
        <?php 
            require_once("nav.php");
            require_once("sidebar.php");
        ?>

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard
                            <small> Nội dung</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <?php 
                    list($result1,$result2,) = get_users_defaulting($_SESSION['aid']);
                    $row1 = mysqli_fetch_row($result1);
                    $row2 = mysqli_fetch_row($result2);
                ?>
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-warning fa-3x"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="huge"><b></b><?php echo $row1[0] ?></div>
                                        <div>Số khách quá hạn</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#late">
                                <div class="panel-footer">
                                    <span class="pull-left"><b>Phạt quá hạn</b></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div><!-- ./panel-closes -->

                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt2">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-3x"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="huge"><b></b><?php echo $row2[0] ?></div>
                                        <div>Khách hàng quá hạn</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#defaulting">
                                <div class="panel-footer">
                                    <span class="pull-left"><b>Xóa người dùng</b></span>
                                    <span class="pull-right"><i class="fa fa-trash fa-2x"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> <!-- ./panel-closes -->

                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt2">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-spinner fa-3x"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="huge"><b></b><?php include('pendingcount.php'); ?></div>
                                        <div>Số hóa đơn đang chờ</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#defaulting00">
                                <div class="panel-footer">
                                    <span class="pull-left"><b>Hóa đơn đang chờ</b></span>
                                    <span class="pull-right"><i class="fa fa-spinner fa-2x"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> <!-- ./panel-closes -->


                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt2">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-dollar fa-3x"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="huge"><b></b><?php include('billamtcount.php'); ?></div>
                                        <div>Tổng số tiền thanh toán</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#defaulting00">
                                <div class="panel-footer">
                                    <span class="pull-left"><b>Tổng tiền hóa đơn</b></span>
                                    <span class="pull-right"><i class="fa fa-dollar fa-2x"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div> <!-- ./panel-closes -->
                </div><!-- ./row -->


                <div class="row">
                    <?php 
                        list($result1,$result2) = get_admin_stats($_SESSION['aid']);
                        $row1 = mysqli_fetch_row($result1);
                        $row2 = mysqli_fetch_row($result2);
                     ?>
                     <div class="col-lg-3 col-xs-6"></div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="panel panel-bolt">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file fa-3x"></i>
                                    </div>
                                    <div class="col-md-9 text-right">
                                        <div class="huge"><b></b><?php echo $row2[0]; ?></div>
                                        <div>Hóa đơn đã tạo</div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div><!-- ./panel-closes -->
                    <div class="col-lg-3 col-xs-6"></div>
                </div>

                

                 <!-- Modal cho phạt người dùng quá hạn thanh toán-->
                                <div class="modal fade" id="late" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h3 class="modal-title"><b>Phạt quá hạn</b></h3>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p><h4></h4></p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="dash_defaulting_users.php" method="post">                                               
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
                                                    <button type="submit" id="late_user" name="late_user" class="btn btn-success ">Có</button>
                                                </form> 
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                 <!-- Modal xóa người dùng quá hạn-->
                                <div class="modal fade" id="defaulting" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Đóng</span></button>
                                                <h3 class="modal-title"><b>Xóa người dùng</b></h3>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p><h4>?</h4></p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="dash_defaulting_users.php" method="post">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
                                                    <button type="submit" id="defaulting_user" name="defaulting_user" class="btn btn-success ">Có</button>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    

<?php
    require_once("js.php");
?>

</body>

</html>
