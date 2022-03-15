<?php 
    require_once('head_html.php'); 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php'); 
    require_once('../Includes/admin.php'); 
    if ($logged==false) {
         header("Location:../index.php");
    }
    elseif ($_SESSION['account'] != 0 and $_SESSION['account'] != 1) {
        header("Location:.../index.php");
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
                            Hóa đơn
                        </h1>

                        <!-- Pills Tabbed GENERATED | GENERATE -->
                        <ul class="nav nav-pills nav-justified">
                            <li class="active"><a href="#generated" data-toggle="pill">Lịch sử hóa đơn</a>
                            </li>
                            <li class=""><a href="#generate" data-toggle="pill">Tạo hóa đơn mới</a>
                            </li>
                            <li class=""><a href="#generate1" data-toggle="pill">Chờ duyệt</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="generated">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-striped" id="list">
                                        <thead>
                                            <tr>
                                                <th>SHĐ</th>
                                                <th>Khách hàng</th>
                                                <th>Ngày lập</th>
                                                <th>Số điện</th>
                                                <th>Số tiền</th>
                                                <th>Phạt quá hạn</th>
                                                <th>Tổng tiền</th>
                                                <th>Hạn thanh toán</th>
                                                <th>Ngày thanh toán</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $id=$_SESSION['aid'];
                                            $result = get_bills_generated($_SESSION['aid']);
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <td><?php echo 'BN_'.$row['bid']?></td>
                                                    <td height="50"><?php echo $row['user'] ?></td>
                                                    <td><?php echo $row['bdate'] ?></td>
                                                    <td><?php echo $row['units'] ?></td>
                                                    <td><?php echo $row['amount'].' VNĐ' ?></td>
                                                    <td><?php echo $row['dues'].' VNĐ' ?></td>
                                                    <td><?php echo $row['pay'].' VNĐ' ?></td>
                                                    <td><?php echo $row['ddate'] ?></td>
                                                    <td><?php echo $row['pdate'] ?></td>
                                                    <td><?php if($row['status'] == 'Đã thanh toán') { echo'<span class="badge" style="background: green;">'.$row["status"].'</span>'; } else { echo'<span class="badge" style="background: red;">'.$row["status"].'</span>';} ?></td>
                                                </tr>
                                            <?php 
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- .table-responsive -->
                            </div>
                            <!-- .tab-genereated -->

                            <div class="tab-pane fade" id="generate">
                                
                                    <?php
                                    $sql = "SELECT curdate1()";
                                    $result = mysqli_query($con,$sql);
                                    if($result === FALSE) {
                                        echo "FAILED";
                                        die(mysql_error()); 
                                    }
                                    $row = mysqli_fetch_row($result);
                                    // echo $row[0];
                                    if ($row[0] == 1) {
                                        include("generate_bill_table.php") ;
                                    }
                                    else
                                    {
                                        //echo "<div class=\"text-danger text-center\" style=\"padding-top:100px; font-size: 30px;\">";
                                        //echo " <b><u>Hóa đơn chỉ được lập vào ngày đầu của tháng</u></b>";
                                        //echo " </div>" ;
										include("generate_bill_table.php") ;
                                    }
                                     
                                    ?>
                            </div>

                            <div class="tab-pane fade" id="generate1">

                                <?php
                                include ("pending_bill.php");
                                ?>

                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.col-lg-12 -->
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

