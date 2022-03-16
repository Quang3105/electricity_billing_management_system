<?php 
    require_once('head_html.php'); 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php'); 
    require_once('../Includes/user.php'); 

    if ($logged==false) {
         header("Location:../index.php");
    }
    elseif ($_SESSION['account'] != 2) {
        header("Location:../index.php");
    }
?>

<style>
    .panel-bolt {
    border-color: #464646;
}

.panel-bolt .panel-heading {
    border-color: #464646;
    color: #fff;
    background-color: #464646;
}
</style>

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
                            <small>Nội dung</small>
                        </h1>
                        <?php
                            require_once("../Includes/session.php");
                            require_once("../Includes/config.php");
                        ?>
                        <!-- STATISTICS -->
                        <h1 style="padding-left:30px;" class="text-muted text-centered">Tình trạng</h1>
                        <div class="row" style="margin-top: 20px;">

                            <?php 
                                list($result1,$result2) = get_user_stats($_SESSION['uid']);
                                $row1 = mysqli_fetch_row($result1);
                                $row2 = mysqli_fetch_row($result2);
                             ?>

                            <div class="col-lg-4 col-xs-6">
                                <div class="panel panel-bolt">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-dollar fa-3x"></i>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <div class="huge"><b></b><?php echo $row2[0]; ?></div>
                                                <div>Hóa đơn đã thanh toán</div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div><!-- ./panel-closes -->

                            <div class="col-lg-4 col-xs-6">
                                <div class="panel panel-bolt">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-dollar fa-3x"></i>
                                            </div>
                                            <div class="col-md-9 text-right">
                                                <div class="huge"><b></b><?php echo $row1[0]; ?></div>
                                                <div>Hóa đơn chờ thanh toán</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- ./panel-closes -->

                        </div><!-- ./row -->


                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
    require_once("js.php");
?>

</body>

</html>
