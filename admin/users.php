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
                            Khách hàng
                            <small>Chi tiết</small>
                        </h1>
                        <ol class="breadcrumb">
                          <li>Khách hàng</li>
                          <li class="active">Chi tiết</li>
                        </ol>
                        <div class="table-responsive" style="padding-top: 0">
                                <table class="table table-hover table-bordered table-condensed" id="list">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên</th>
                                            <th>Giới tính</th>
                                            <th>Ngày sinh</th>
                                            <th>Email</th>
                                            <th>SĐT</th>
                                            <th>Địa chỉ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php 
                                            $id=$_SESSION['aid'];
                                            $result = get_users_detail($_SESSION['aid']);

                                            $cnt=1;
                                            while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                                <tr>
                                                    <td height="50"><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['name'] ?></td>
                                                    <td><?php if ($row['gender'] == 0) {echo "Nữ";} else {echo "Nam";} ?></td>
                                                    <td><?php echo $row['birthday'] ?></td>
                                                    <td><?php echo $row['email'] ?></td>
                                                    <td><?php echo $row['phone'] ?></td>
                                                    <td><?php echo $row['address'] ?></td>                                                    
                                                </tr>
                                            <?php $cnt++; } ?>
                                    </tbody>
                                </table>
                        </div>
                        <!-- ./table -rsponsive -->
                        
                    </div><!-- ./col -->

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
