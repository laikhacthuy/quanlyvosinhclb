<?php
	require ("../../BackEnd/DB_driver.php");
    require ("../../BackEnd/DB_business.php");
    require ("../../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $mahlv=$_GET['mahlv'];
    $huanluyenvien = new huanluyenvien();
    $huanluyenvien->xoa_hlv($mahlv);
    header("location:../danhsachhlv.php");
    $db->dis_connect();
?>