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
                            Thanh toán
                        </h1>
                        <ol class="breadcrumb">
                          <li>Thanh toán</li>
                          <li class="active">Lịch sử</li>
                        </ol>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered table-condensed" id="list">
                                <thead>
                                    <tr>
                                        <th>Số thanh toán</th>
                                        <th>Ngày lập</th>
                                        <th>Số tiền</th>
                                        <th>Phạt quá hạn</th>
                                        <th>Số tiền phải trả</th>
                                        <th>Ngày thanh toán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $id=$_SESSION['uid'];

                                    $result = retrieve_transaction_history($_SESSION['uid']);
                                    while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                        <tr>
                                            <td>
                                                <?php 
                                                    if($row['pdate']!=NULL) echo 'TRN_'.$row['id'] ;
                                                    else echo "-";
                                                 ?>
                                            </td>
                                            <!-- <?php echo $row['id'] ?></td> -->
                                            <td height="50"><?php echo $row['bdate'] ?></td>
                                            <td><?php echo $row['amount']." VNĐ" ?></td>
                                            <td><?php echo $row['dues']." VNĐ" ?></td>
                                            <td><?php echo $row['payable']." VNĐ" ?></td>
                                            <td>
                                                <?php 
                                                    if($row['pdate']!=NULL) echo $row['pdate'];
                                                    else echo "Đang chờ";
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- .table-responsive -->
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
