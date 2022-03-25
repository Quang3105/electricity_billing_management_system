<?php
require_once('head_html.php');
require_once('../Includes/config.php');
require_once('../Includes/session.php');
require_once('../Includes/admin.php');

if (isset($_GET['id'])) {
    $_SESSION['uid'] = $_GET['id'];
}

$query1 = "SELECT * FROM `admin` where id = {$_SESSION['uid']}";
$result1 = mysqli_query($con,$query1);
$row = mysqli_fetch_assoc($result1);

if (isset($_POST["update_submit"])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['inputPassword'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['contactNo'];
    $address = $_POST['address'];
    $role = $_POST['role'];


    $query2 = "UPDATE `admin` set name = '$name', gender = $gender, birthday = '$birthday', email = '$email', phone = '$phone', pass = '$password', address = '$address',role = $role  where id = {$_SESSION['uid']}";
    $result2 = mysqli_query($con,$query2);
    header("Location:employees.php");
}
        ?>

<body>
    <div id="wrapper">
        <?php
        require_once("nav.php");
        require_once("sidebar.php");
        ?>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Nhân viên
                            <small>Sửa thông tin nhân viên</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>Nhân viên</li>
                            <li class="active">Sửa thông tin nhân viên</li>
                        </ol>
                    <!-- /col-lg-6 -->
                    <div class="col-lg-6">
                        <form action="update_employee.php" method="post" class="form-horizontal" role="form">
                                <div class="row form-group">
                                    <div class="col-md-8">
                                        <label>Tên đầy đủ:</label>
                                        <input type="name" class="form-control" name="name" id="name" value="<?php echo $row['name']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8">
                                        <label>Email:</label>
                                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>" required>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8">
                                        <label>Mật khẩu:</label>
                                        <input type="password" class="form-control" name="inputPassword" id="inputPassword" value="<?php echo $row['pass']; ?>" required>
                                        
                                    </div>
                                </div><br>


                                <div class="form-group">
                                    <div class="col-md-8" id="inputgender" style="margin-top: -15px">
                                        <label>Giới tính:</label>
                                        <select name="gender" aria-labelledby="inputgender" class="form-control" required>
                                            <option value="1" <?php echo  ($row['gender'] == 1 ? 'selected' : '') ?> >Nam</option>
                                            <option value="0" <?php echo  ($row['gender'] == 0 ? 'selected' : '') ?> >Nữ</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-8">
                                        <label>Ngày sinh:</label>
                                        <input type="date" name="birthday" id="inputbirthday" class="form-control" value="<?php echo date('Y-m-d', strtotime($row['birthday'])) ?>" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8">
                                        <label>SĐT:</label>
                                        <input type="tel" class="form-control" name="contactNo" value="<?php echo $row['phone']; ?>" required>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-8">
                                        <label>Địa chỉ:</label>
                                        <input type="address" class="form-control" name="address" value="<?php echo $row['address']; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8" id="role">
                                        <label>Vai trò:</label>
                                        <select name="role" aria-labelledby="role" class="form-control" required>
                                            <option value="0" <?php echo ($row['role'] == 0 ? 'selected' : '') ?> >Admin</option>
                                            <option value="1" <?php echo ($row['role'] == 1 ? 'selected' : '') ?>>Nhân viên</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <button name="update_submit" class="btn btn-primary" style="margin-left: 15px">Sửa</button>
                                        <button onclick="window.location = '../admin/employees.php';return false" name="emp_cancel" class="btn btn-warning">Hủy</button>
                                </div>
                        </form>

                    </div>
                    <!-- /col-lg-6 -->

                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
    </div>
    </div>
    <?php
    require_once("js.php");
    ?>
</body>

