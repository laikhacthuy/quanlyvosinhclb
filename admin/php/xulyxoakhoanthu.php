<?php
	require ("../../BackEnd/DB_driver.php");
    require ("../../BackEnd/DB_business.php");
    require ("../../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $makhoanthu=$_GET['makhoanthu'];
    $khoanthu= new khoanthu();
    $khoanthu->xoa_khoanthu($makhoanthu);
    header('location: ../danhsachkhoanthu.php');
    $db->dis_connect();
?>