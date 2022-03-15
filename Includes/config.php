<?php
    $host='localhost'; # MySQL Host
    $mysql_user="root";# MySql Username
    $mysql_pwd=""; # MySql Password
    $dbms="db_tttd"; # Database

    $con = mysqli_connect($host,$mysql_user,$mysql_pwd,$dbms);
    if (!$con) die('Không thể kết nối tới: ' . mysql_error());
    mysqli_select_db($con,$dbms) or die("không chọn đc " . mysql_error());
?>