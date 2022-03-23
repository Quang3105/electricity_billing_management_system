<?php
require_once('../Includes/config.php');
require_once('../Includes/session.php');
require_once('../Includes/admin.php');

if (isset($_POST['delempid'])) {
    $query  = " DELETE FROM `admin` WHERE id = {$_POST['delempid']}";
    if (!mysqli_query($con,$query))
    {
        die('Lỗi: ' . mysqli_error($con));
    }
}
header("Location:employees.php");
?>