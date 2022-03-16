<?php
require_once('../Includes/config.php');
require_once('../Includes/session.php');
require_once('../Includes/admin.php');

$aid = $_SESSION['aid'];
if (isset($_POST['bid'])) {
    $bid = $_POST['bid'];
}
if (isset($_POST['uid'])) {
    $uid = $_POST['uid'];
}

if (isset($_POST['accept_bill'])) {
    $query1 = " UPDATE `bill` SET `status` = 'Đã thanh toán' WHERE `id` = {$bid} ";
    $result1 = mysqli_query($con,$query1);
    if (!mysqli_query($con,$query1))
    {
        die('Lỗi: ' . mysqli_error($con));
    }
}

if (isset($_POST['decline_bill'])) {
    $query2 = " UPDATE `bill` SET `status` = 'Thanh toán lại' WHERE `id` = {$bid} ";
    $result2 = mysqli_query($con,$query2);
    if (!mysqli_query($con,$query2))
    {
        die('Lỗi: ' . mysqli_error($con));
    }
}
header("Location:bill.php");
?>