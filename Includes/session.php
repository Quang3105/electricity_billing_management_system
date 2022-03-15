<?php
    require_once("config.php");
    session_start();
    $logged = false;
    //checking if anyone(admin/email)is logged in or not
    if(isset($_SESSION['logged']))
    {
        if ($_SESSION['logged'] == true)
        {
            $logged = true ;
            $email = $_SESSION['email'];
        }
    }
    else
        $logged=false;

    if($logged != true)
    {
        $email = "";
        if (isset($_POST['email']) && isset($_POST['pass']))
        {
            $email=$_POST['email'];
            $password=$_POST['pass'];            
            $email = stripslashes($email);
            $email = mysqli_real_escape_string($con,$email);
            $password = stripslashes($password);
            $password = mysqli_real_escape_string($con,$password);
            
            // user
            $sql = "SELECT * FROM user WHERE email='$email' AND pass='$password' ";
            $result = mysqli_query($con,$sql);
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                $_SESSION['user'] = $row['name'];
                $_SESSION['logged']=true;
                $_SESSION['email'] = $email;
                $_SESSION['account']= $row['status'];
                if ($_SESSION['account'] == 0 or $_SESSION['account'] == 1) {
                    $_SESSION['aid'] = $row['id'];
                    header("Location:admin/index.php");
                }
                else {
                    $_SESSION['uid']=$row['id'];
                    header("Location:user/index.php");
                }
            }
        }
    }
?>