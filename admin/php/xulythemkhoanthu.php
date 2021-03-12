<?php
    session_start();
	require ("../../BackEnd/DB_driver.php");
    require ("../../BackEnd/DB_business.php");
    require ("../../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $khoanthu= new khoanthu();
    if(isset($_POST['save']))
    {
    	$makhoanthu = $_POST['makhoanthu'];
        $tenkhoanthu =$_POST['tenkhoanthu'];
        $mucdong =$_POST['mucdong'];
        $ngaydong = $_POST['ngaydong'];
        $trangthai = $_POST['trangthai'];
        $ghichu = $_POST['ghichu'];

        $ds= $khoanthu->check_khoanthu($makhoanthu);
        if($ds>0)
        {
            header('location: ../themmoikhoanthu.php');
            $err="Mã đã tồn tại, vui lòng nhập lại";
            $_SESSION['tt']=$err;
        }else
        if($ds<=0)
        {
            $data= array(
                'MAKHOANTHU'  => $makhoanthu,
                'TENKHOANTHU' => $tenkhoanthu,
                'MUCDONG' => $mucdong,
                'NGAYTHANG' => $ngaydong,
                'TRANGTHAI' => $trangthai,
                'GHICHU' => $ghichu,
            );
            $khoanthu->insert_khoanthu($data);
            header('location: ../themmoikhoanthu.php');
            $err="Thêm khoản thu thành công";
            $_SESSION['tt']=$err;
        }
    }
    $db->dis_connect();
?>