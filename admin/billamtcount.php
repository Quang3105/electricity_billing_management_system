<?php 

include('../Includes/config.php');


$result = mysqli_query($con, 'SELECT SUM(pay) AS value_sum FROM bill WHERE status = "Đã thanh toán"');
$row = mysqli_fetch_assoc($result); 
echo ($sum = $row['value_sum']).' VNĐ';

?>