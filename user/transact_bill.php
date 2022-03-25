<?php 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php');
    require_once('../Includes/user.php');

    $uid = $_SESSION['uid'];
    $bid = $_POST['bid'];
    $bdate = $_POST['bdate'];
    $ddate = $_POST['ddate'];
    $units = $_POST['units'];
    $amount = $_POST['amount'];
    $payable = $_POST['payable'];


    if (isset($_POST['pay_bill'])) {
        $query  =  "UPDATE user , bill ";
        $query .=  "SET bill.status='Chờ duyệt' , pdate=curdate() ";
        $query .=  "where user.id={$uid} AND bill.id={$bid} ";

        if (!mysqli_query($con,$query))
        {
                die('Lỗi: ' . mysqli_error($con));
        }
    }

    header("Location:bill.php");
?>