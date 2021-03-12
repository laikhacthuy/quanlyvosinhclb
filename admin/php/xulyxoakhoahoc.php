<?php
	require ("../../BackEnd/DB_driver.php");
    require ("../../BackEnd/DB_business.php");
    require ("../../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $makh=$_GET['makh'];
    $khoahoc= new khoahoc();
    $khoahoc->xoa_khoahoc($makh);
    header('location: ../danhsachkhoahoc.php');
    $db->dis_connect();
?>