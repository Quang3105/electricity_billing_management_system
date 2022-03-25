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
                            Hóa đơn
                        </h1>

                        <!-- Lựa chọn Lịch sử - Hạn đóng -->
                        <ul class="nav nav-pills nav-justified">
                            <li class="active"><a href="#history" data-toggle="pill">Lịch sử</a>
                            </li>
                            <li class=""><a href="#due" data-toggle="pill">Hạn đóng</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="history">
                                <!-- Lịch sử hóa đơn đã thanh toán của người dùng -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered table-condensed" id="list">
                                        <thead>
                                            <tr>
                                                <th>Số hóa đơn</th>
                                                <th>Ngày lập</th>
                                                <th>Số điện tiêu thụ</th>
                                                <th>Giá tiền</th>
                                                <th>Hạn thanh toán</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $id=$_SESSION['uid'];

                                            $result = get_bills_history($_SESSION['uid']);
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <td height="50"><?php echo 'EBS_'.$row['id'] ?></td>
                                                    <td height="50"><?php echo $row['bdate'] ?></td>
                                                    <td><?php echo $row['units'] ?></td>
                                                    <td><?php echo $row['amount']." VNĐ" ?></td>
                                                    <td><?php echo $row['ddate'] ?></td>
                                                    <td><?php echo $row['status'] ?></td>
                                                </tr>
                                            <?php   } ?>
                                        </tbody>
                                    </table>     
                                </div>
                                <!-- .table-responsive -->
                            </div>
                            <div class="tab-pane fade" id="due">
                                <!-- <h4>Các hóa đơn chưa đóng -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <!-- <th>#</th> -->
                                                <th>Ngày lập hóa đơn</th>
                                                <th>Số điện tiêu thụ</th>
                                                <th>Hạn thanh toán</th>
                                                <th>Số tiền</th>
                                                <th>Phạt quá hạn</th>
                                                <th>Số tiền phải trả</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 

                                            $id=$_SESSION['uid'];

                                            $result = get_bills_due($_SESSION['uid']);
                                            $counter = 1;
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <form action="transact_bill.php" method="post">
                                                    <!-- <td height="40"><?php echo $counter ?></td> -->

                                                    <input type="hidden" name="bid" value="<?php echo $row['id'] ?>">

                                                    <input type="hidden" name="bdate" value=<?php echo $row['bdate'] ?> >
                                                        1
                                                    <td td height="50"><?php echo $row['bdate'] ?></td>

                                                    <input type="hidden" name="units" value=<?php echo $row['units'] ?> >
                                                    <td><?php echo $row['units'] ?></td>

                                                    <input type="hidden" name="ddate" value=<?php echo $row['ddate'] ?> >
                                                    <td><?php echo $row['ddate'] ?></td>

                                                    <input type="hidden" name="amount" value=<?php echo $row['amount'] ?> >
                                                    <td><?php echo $row['amount']." VNĐ" ?></td>

                                                    <!-- <input type="hidden" name="" value=<?php echo $row[''] ?> > -->
                                                    <td><?php echo $row['dues']." VNĐ" ?></td>

                                                    <input type="hidden" name="payable" value=<?php echo $row['payable'] ?> >
                                                    <td><?php echo $row['payable']." VNĐ" ?></td>

                                                    <td>
                                                    <button class="btn btn-success form-control" data-toggle="modal"  data-target="#PAY">Thanh toán</button>
                                                    <!--MODAL THANH TOÁN HÓA ĐƠN -->
                                                    <div class="modal fade" id="PAY" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-sm">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Đóng</span></button>
                                                                    <h3 class="modal-title text-centre"><b>Thanh toán hóa đơn</b></h3>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <h4>?</h4>
                                                                    <p>Thanh toán trước ngày <?php echo $row['ddate']; ?> nếu không sẽ phải nộp phạt!!</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                                                        <button type="submit" id="pay_bill" name="pay_bill" class="btn btn-success ">Thanh toán</button>
                                                    </form> 
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                </td>
                                                </tr>
                                            <?php 
                                                $counter=$counter+1;
                                            }
                                            ?>
                                        </tbody>

                                    </table>


                                </div><!-- ./table-responsive -->

                            </div> <!-- .tab-pane -->
                           
                        </div><!-- .tab-content -->

                    </div><!-- /.col-lg-12 -->
                    
                </div> <!-- /.row -->
               
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