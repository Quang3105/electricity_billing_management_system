<!--trang sửa giá điện-->

<!--CREATE TABLE `unitsprice` (
  `level` int(1) DEFAULT NULL,
  `price` int(14) NOT NULL
);
-->


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


    <div class="col-md-4" style="padding-top: 30px; padding-left: 250px; width: 800px;">
        <h1 class="page-header">
            Sửa Giá Điện
        </h1>

        <table class="table table-hover" border="1">
            <thead>
                <tr>
                    <th>Level</th>
                    <th>Giá Điện</th>
                    <th style="width: 30px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query1 = "SELECT * FROM `unitsprice`";
                    $result1 = mysqli_query($con,$query1);
                    //$row1 = mysqli_fetch_row($result1);
                   
                    while($row = mysqli_fetch_assoc($result1)){
                    ?>
                    <tr>
                            <td><?php echo $row['level']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td>
                                <a href="update_price.php?level=<?php echo  $row['level']; ?>"><button class="btn btn-warning">Sửa</button></a>
                            </td>                                        
                    </tr>

                <?php } ?>
            </tbody>
        </table>

    </div>



    <?php
    require_once("js.php");
    ?>
</body>
</html>

