<?php
require_once("Includes/session.php");
$nameErr = $phoneErr = $addrErr = $emailErr = $passwordErr = $confpasswordErr = "";
$name = $email = $password = $confpassword = $address = "";
$flag=0;

//check dữ liệu người dùng nhập vào
function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

if(isset($_POST["reg_submit"])) {
        $email = test_input($_POST['email']); 
        $password = test_input($_POST["inputPassword"]);
        $confpassword = test_input($_POST["confirmPassword"]);
        $address = test_input($_POST["address"]);
        $email = test_input($_POST['email']);

        // NAME VALIDATION
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
            $flag=1;
            echo $nameErr;
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameErr = "Chỉ được phép nhập kí tự và dấu cách";
                $flag=1;
                echo $nameErr;
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Yêu cầu có email";
            $flag=1;
            } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Định dạng email không hợp lệ";
                $flag=1;
                echo $emailErr;
            }
        }

        if (empty($_POST["inputPassword"]))
        {
            $passwordErr = "Hãy điền mật khẩu";
            $flag=1;
        }
        else 
        {
            $password = $_POST["inputPassword"];
        }
        if (empty($_POST["confirmPassword"]))
        {
            $confpasswordErr = "thiếu";
            $flag=1;
        }
        else 
        {
            if($_POST['confirmPassword'] == $password)
            {
                $confpassword = $_POST["confirmPassword"];
            }
            else
            {
                $confpasswordErr = "Mật khẩu không khớp!";
                $flag = 1;
            }
        }

        if (empty($_POST["address"])) {
            $addrErr = "Hãy điền địa chỉ";
            $flag=1;
            echo $addrErr;
        } else {
            $address = test_input($_POST["address"]);
            // if (!preg_match("/^[a-zA-Z1-9]*$/",$address)) {
            //     $addrErr = "Chỉ cho phép điền ký tự và dấu cách";
            //     // $flag=1; 
            //     echo $addrErr;
            // }
        }

        if (empty($_POST["contactNo"])) {
            $flag=1;
            $contactNo = "";
            // echo "có lỗi";
        } else {
            $contactNo = test_input($_POST["contactNo"]);
            if(!preg_match("/^d{10}$/", $_POST["contactNo"])){
                $phoneErr="Số điện thoại nhiều nhất 10 chữ số";
                echo $_POST['contactNo'];
            }
        }

        echo $flag;
        if($flag == 0)
        {
            require_once("Includes/config.php");
            $sql = "INSERT INTO user (`name`,`email`,`phone`,`pass`,`address`)
                    VALUES('$name','$email','$contactNo','$password','$address')";
                    echo $sql;
            if (!mysqli_query($con,$sql))
            {
                die('Lỗi: ' . mysqli_error($con));
            }
            header("Location:index.php");
        }
    }
?>

<form action="signup.php" method="post" class="form-horizontal" role="form" onsubmit="return validateForm()">
<center>
    <div class="row form-group">
        <div class="col-md-12">
            <input type="name" class="form-control" name="name" id="name" placeholder="Tên đầy đủ" required>
            <!-- <label><?php echo $nameErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            <!-- <label><?php echo $emailErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Mật khẩu" required>
            <!-- <label><?php echo $passwordErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="password" class="form-control" name="confirmPassword" placeholder="Xác nhận mật khẩu" required>
            <!-- <label><?php echo $confpasswordErr;?></label><label><?php echo $confpasswordErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="tel" class="form-control" name="contactNo" placeholder="Số điện thoại" required>
            <!-- <label><?php echo $phoneErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <input type="address" class="form-control" name="address" placeholder="Địa chỉ" required>
            <!-- <label><?php echo $addrErr;?></label> -->
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-10">
            <button name="reg_submit" class="btn btn-primary">Đăng ký</button>
        </div>
    </div>
    </center>
</form>
