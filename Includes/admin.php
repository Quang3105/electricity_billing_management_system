<?php 
    // require_once("config.php");

    function get_bills_generated($id) {
        global $con;
        $query  = "SELECT user.name AS user, bill.bdate AS bdate , bill.units AS units , bill.amount AS amount , bill.dues AS dues, bill.pay AS pay, bill.id as bid ";
        $query .= ", bill.ddate AS ddate, bill.status AS status, bill.pdate AS pdate ";
        $query .= " FROM user , bill ";
        $query .= " WHERE user.id=bill.uid AND aid={$id} AND bill.status != 'Chờ duyệt'";
        $query .= " ORDER BY bill.id DESC ";

        $result = mysqli_query($con,$query);
        if($result === FALSE) {
            die(mysql_error());
        }
        return $result;
    }
    function get_bills_pending($id) {
        global $con;
        $query  = "SELECT user.name AS user, bill.bdate AS bdate , bill.units AS units , bill.amount AS amount , bill.dues AS dues, bill.pay AS pay, bill.id as bid ";
        $query .= ", bill.ddate AS ddate, bill.status AS status ";
        $query .= " FROM user , bill ";
        $query .= " WHERE user.id=bill.uid AND aid={$id} AND bill.status = 'Chờ duyệt'";
        $query .= " ORDER BY bill.id DESC ";

        $result = mysqli_query($con,$query);
        if($result === FALSE) {
            die(mysql_error());
        }
        return $result;
    }

    function get_bill_data(){
        global $con;
        $query  = "SELECT curdate() AS bdate , adddate( curdate(),INTERVAL 30 DAY ) AS ddate , user.id AS uid , user.name AS uname FROM user ";
        // echo $query;
        $result = mysqli_query($con,$query);
        if($result === FALSE) {
            die(mysql_error());
        }
        return $result;
    }


    function get_users_detail($id)
    {
        global $con;
        $query  = "SELECT * FROM user";
        $result = mysqli_query($con,$query);
        if($result === FALSE) {
            die(mysql_error());
        }
        return $result;
    }

    function get_admins_detail($id)
    {
        global $con;
        $query  = "SELECT * FROM admin WHERE id != {$id}";
        $result = mysqli_query($con,$query);
        if($result === FALSE) {
            die(mysql_error());
        }
        return $result;
    }

    function get_admin_stats($id)
    {
        global $con;
        $query1  = " SELECT count(id) AS unprocessed_bills FROM bill  WHERE status = N'Đang chờ'  AND aid = {$id} ";
        $query2  = " SELECT count(id) AS generated_bills FROM bill  WHERE aid = {$id} " ;

        $result1 = mysqli_query($con,$query1);
        if($result1 === FALSE) {
            echo "FAILED1";
            die(mysql_error());
        }

        $result2 = mysqli_query($con,$query2);
        if($result2 === FALSE) {
            echo "FAILED2";
            die(mysql_error()); //
        }

        return array($result1,$result2);
    }

    function get_users_defaulting($id){
        global $con;

        //TODO : cần chỉnh sửa thêm cho cập nhật mức phạt!
        $query1  = "SELECT COUNT(*) FROM bill ";
        $query1 .= "WHERE curdate() > bill.ddate AND curdate() < adddate(bill.ddate , INTERVAL 25 DAY ) ";
        $query1 .= "AND bill.aid={$id} AND bill.status=N'Đang chờ' ";

        $query2  = "SELECT COUNT(*) FROM bill  ";
        $query2 .= "WHERE curdate() > adddate(bill.ddate , INTERVAL 25 DAY ) ";
        $query2 .= "AND bill.aid={$id} AND bill.status=N'Đang chờ' ";


        $result1 = mysqli_query($con,$query1);
        if (!$result1)
            {
                die('1Error: ' . mysqli_error($con));
            }

        $result2 = mysqli_query($con,$query2);
        if (!$result2)
            {
                die('2Error: ' . mysqli_error($con));
            }
        return array($result1,$result2,);
    }
 ?>