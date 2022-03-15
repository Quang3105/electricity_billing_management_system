<?php
  require_once("Includes/config.php");
  require_once("Includes/session.php");
  /*if(!(isset($_POST['email']&&isset($_POST['pass'])))) {
    location('index.php');
  }*/
   // if ($count === 0) {
  // echo "Có lỗi";
// }
  ?>

<form action="index.php" class="navbar-form navbar-right" role="form" method="post" name="myForm">
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Email" name="email" id="email">
    </div>
    <div class="form-group">
        <input type="password" placeholder="Mật khẩu" name="pass" id="pass" class="form-control">
    </div>
    <button type="login_submit" class="btn btn-success" onclick="validateForm()">Đăng nhập</button>
</form>

