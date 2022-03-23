<?php 
    require_once('head_html.php'); 
    require_once('../Includes/config.php'); 
    require_once('../Includes/session.php'); 
    require_once('../Includes/admin.php'); 
    if ($logged==false) {
         header("Location:../index.php");
    }
    elseif ($_SESSION['account'] != 0 and $_SESSION['account'] != 1) {
        header("Location:.../index.php");
    }
?>



<body>


 <div id="wrapper">

        <?php
            require_once("nav.php");
            require_once("sidebar.php");
        ?>
    </div>

<?php
    if (isset($_GET['level'])) {
        // code...
        $level = $_GET['level'];
    }
?>

<?php
    $query1 = "SELECT * FROM `unitsprice` where level = '$level'";
    $result1 = mysqli_query($con,$query1);
    $row = mysqli_fetch_assoc($result1);
?>

<?php
    if (isset($_POST["sua"])) {
       // $level = $_POST['level'];
        $price = $_POST['price'];

       if ($price == "") {
            echo "Vui lòng nhập giá điện mới.";
           // code...
       }

       if ($price != "") {
            $query1 = "UPDATE `unitsprice` set price = '$price' where level = $level";
            $result1 = mysqli_query($con,$query1);
           // code...
       }
         // code...
     } 
?>

    
    
    <div class="col-lg-6" style="padding-top: 130px; padding-left: 500px;">
    <form method="post">
        <h3>Sửa Giá Điện</h3>
        <label>Level <?php echo $row['level']; ?></label>
        <br>
        <label>Giá Điện:</label>
        <input type="text" name="price" value="<?php echo $row['price']; ?>">
        <br><br>
        <input type="submit" name="sua" value="Sửa">   
    </form>
    <br>

    <a href="table_price.php"><button class="btn btn-warning">Thoát</button></a>

    </div>


    <?php
    require_once("js.php");
    ?>
</body>
</html>

