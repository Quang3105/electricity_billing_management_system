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
                        Nhân viên
                        <small>Chi tiết</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>Nhân viên</li>
                        <li class="active">Chi tiết</li>
                    </ol>
                    <?php if ($_SESSION['account'] == 0): ?>
                    <a class="btn btn-block btn-sm btn-default border-primary " href="new_employee.php" style="margin: 10px;"><i class="fa fa-plus"></i>Thêm nhân viên mới</a>
                    <?php endif; ?>
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
                                        <?php if ($_SESSION['account'] == 0): ?>
                                        <th>Hành động</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id=$_SESSION['aid'];
                                    $result = get_admins_detail($_SESSION['aid']);

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
                                            <?php if ($_SESSION['account'] == 0): ?>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Hành động
                                                        <span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="update_emp" href="update_employee.php?id=<?php echo  $row['id']; ?>">Sửa</a></li>
                                                        <li class="divider"></li>
                                                        <li><a class="delete_emp" href="#" data-toggle="modal" data-target="#delete_emp_modal" data-id="<?php echo $row['id'] ?>">Xóa</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php $cnt++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- ./table -rsponsive -->

                </div><!-- ./col -->
            </div> <!-- /.row -->
            <div class="modal fade" id="delete_emp_modal" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Đóng</span></button>
                            <h3 class="modal-title"><b>Xóa nhân viên</b></h3>
                        </div>
                        <div class="modal-body text-center">
                            <p><h4>Bạn có chắc muốn xóa nhân viên này?</h4></p>
                        </div>
                        <div class="modal-footer">
                            <form action="delete_employee.php" method="post" >
                                <input type="hidden" id="delempid" name="delempid" value="">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
                                <button type="submit" id="delete_employee" name="delete_employee" class="btn btn-success ">Có</button>
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
<script>
    $('.delete_emp').click(function(){
        var el = document.getElementById('delempid');
        el.value = $(this).attr('data-id');
    })
</script>
</body>

</html>
