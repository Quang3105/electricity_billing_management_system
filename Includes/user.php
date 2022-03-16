<?php 
    // require_once("config.php");

    function get_bills_history($id) {
        global $con;
        $query = "SELECT * FROM bill where uid={$id} ";
        $query .= "ORDER BY bdate DESC ";
        $result = mysqli_query($con,$query);
        return $result;
    }

    function get_bills_due($id) {
        global $con;
        $query  = "SELECT bdate , units, ddate , pay AS payable, ";
        $query .= " amount , pay-amount AS dues , id ";
        $query .= "FROM bill ";
        $query .= "WHERE uid={$id} AND (status='Đang chờ' OR status = 'Thanh toán lại') ";
        $query .= "ORDER BY ddate desc ";
        $result = mysqli_query($con,$query);
        return $result;
    }

    function get_user_details($id) {
        global $con;
        $query  = "SELECT * FROM user where id = {$id}";
        $result = mysqli_query($con, $query);

        if (!$result)   
            {
                die('Lỗi: ' . mysqli_error($con));
            }  
        return $result;
    }

    function get_user_stats($id)
    {
        global $con;
        $query1  = " SELECT count(id) AS unprocessed_bills FROM bill  WHERE uid = {$id} AND (status = 'Đang chờ' OR status = 'Thanh toán lại')  ";
        $query2  = " SELECT count(id) AS payed_bills FROM bill  WHERE uid = {$id} AND status='Đã thanh toán' or status = 'Chờ duyệt'" ;
        // echo $query;
        
        $result1 = mysqli_query($con,$query1);
        if($result1 === FALSE) {
            echo "FAILED1";
            die(mysql_error());
        }

        $result2 = mysqli_query($con,$query2);
        if($result2 === FALSE) {
            echo "FAILED2";
            die(mysql_error());
        }


        return array($result1,$result2);
    }

 ?>