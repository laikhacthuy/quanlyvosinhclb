<?php
    session_start();
	require ("../../BackEnd/DB_driver.php");
    require ("../../BackEnd/DB_business.php");
    require ("../../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $khoahoc= new khoahoc();
    if(isset($_POST['save']))
    {
    	$makhoahoc = $_POST['makhoahoc'];
        $tenkhoahoc =$_POST['tenkhoahoc'];
        $namhoc =$_POST['namhoc'];

        $ds= $khoahoc->check_khoahoc($makhoahoc);
        if($ds>0)
        {
            header('location: ../themmoikhoahoc.php');
            $err="Mã đã tồn tại, vui lòng nhập lại";
            $_SESSION['tt']=$err;
        }else
        if($ds<=0)
        {
            $data= array(
                'MAKH'  => $makhoahoc,
                'TENKHOAHOC' => $tenkhoahoc,
                'NAMHOC' => $namhoc,
            );
            $khoahoc->insert_khoahoc($data);
            header('location: ../themmoikhoahoc.php');
            $err="Thêm khóa học thành công";
            $_SESSION['tt']=$err;
        }
    }
    $db->dis_connect();
?>