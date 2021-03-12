<?php
	require ("../../BackEnd/DB_driver.php");
    require ("../../BackEnd/DB_business.php");
    require ("../../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $taikhoan=$_GET['taikhoan'];
    $nguoidung= new nguoidung();
    $nguoidung->xoa_nguoidung($taikhoan);
    header('location:../danhsachnguoidung.php');
    $db->dis_connect();
?>