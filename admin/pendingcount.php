<?php 

include('../Includes/config.php');

$sql = "SELECT * FROM bill WHERE status ='Đang chờ' OR status = 'Thanh toán lại'";
                $query = $con->query($sql);

                echo "$query->num_rows";


?>