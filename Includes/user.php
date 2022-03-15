<?php 
    // require_once("config.php");

    function retrieve_bills_history($id) {
        global $con;
        $query = "SELECT * FROM bill where uid={$id} ";
        $query .= "ORDER BY bdate DESC ";
        $result = mysqli_query($con,$query);
        return $result;
    }

    function retrieve_bills_due($id) {
        global $con;
        $query  = "SELECT bill.bdate AS bdate, bill.units AS units, bill.ddate AS ddate, transaction.payable AS payable, ";
        $query .= " bill.amount AS amount ,transaction.payable-bill.amount AS dues , bill.id AS id ";
        $query .= "FROM bill , transaction ";
        $query .= "WHERE transaction.bid=bill.id AND bill.uid={$id} AND bill.status='Đang chờ' ";
        $query .= "ORDER BY bill.ddate desc "; 
        $result = mysqli_query($con,$query);
        return $result;
    }
    function retrieve_transaction_history($id) {
        global $con;
        $query  = "SELECT transaction.id AS id , bill.bdate AS bdate, transaction.pdate AS pdate, transaction.payable AS payable, ";
        $query .= " bill.amount AS amount ,transaction.payable-bill.amount AS dues ";
        $query .= "FROM bill , transaction ";
        $query .= "WHERE transaction.bid=bill.id AND bill.uid={$id} ";
        $query .= "ORDER BY bill.ddate desc "; 
        $result = mysqli_query($con,$query);
        return $result;
    }

    function retrieve_user_details($id) {
        global $con;
        $query  = "SELECT * FROM user where id = {$id}";
        $result = mysqli_query($con, $query);

        if (!$result)   
            {
                die('Error: ' . mysqli_error($con));
            }  
        return $result;
    }

    function retrieve_user_stats($id)
    {
        global $con;
        $query1  = " SELECT count(id) AS unprocessed_bills FROM bill  WHERE status = 'Đang chờ'  AND uid = {$id} ";
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