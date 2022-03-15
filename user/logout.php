<?php   
    session_start(); //để đảm bảo đang sử dụng đúng phiên
    session_destroy(); //hủy bỏ phiên đăng nhập
    header("Location:../index.php"); //quay lại trang index ban đầu sau khi đăng xuất
    exit();
?>