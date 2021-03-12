<?php
    session_start();
	require ("../../BackEnd/DB_driver.php");
    require ("../../BackEnd/DB_business.php");
    require ("../../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $khoanthu= new khoanthu();
    if(isset($_POST['capnhat']))
    {
    	$makhoanthu = $_POST['makhoanthu'];
        $tenkhoanthu =$_POST['tenkhoanthu'];
        $mucdong =$_POST['mucdong'];
        $ngaydong = $_POST['ngaydong'];
        $trangthai = $_POST['trangthai'];
        $ghichu = $_POST['ghichu'];
        $data= array(
            'TENKHOANTHU' => $tenkhoanthu,
            'MUCDONG' => $mucdong,
            'NGAYTHANG' => $ngaydong,
            'TRANGTHAI' => $trangthai,
            'GHICHU' => $ghichu,
        );
        $khoanthu->capnhat_khoanthu($data,$makhoanthu);
        header("location:../capnhatkhoanthu.php?makhoanthu=".$makhoanthu."");
        $thanhcong="Cập nhật thành công";
        $_SESSION['thongbao']=$thanhcong;
    }
    $db->dis_connect();
?>