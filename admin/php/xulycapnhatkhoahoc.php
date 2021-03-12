<?php
    session_start();
	require ("../../BackEnd/DB_driver.php");
    require ("../../BackEnd/DB_business.php");
    require ("../../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $khoahoc= new khoahoc();
    if(isset($_POST['capnhat']))
    {
    	$makhoahoc = $_POST['makhoahoc'];
        $tenkhoahoc =$_POST['tenkhoahoc'];
        $namhoc =$_POST['namhoc'];
        $data= array(
            'TENKHOAHOC' => $tenkhoahoc,
            'NAMHOC' => $namhoc,
        );
        $khoahoc->capnhat_khoahoc($data,$makhoahoc);
        header("location:../capnhatkhoahoc.php?makh=".$makhoahoc."");
        $thanhcong="Cập nhật thành công";
        $_SESSION['thongbao']=$thanhcong;  
    }
    $db->dis_connect();
?>