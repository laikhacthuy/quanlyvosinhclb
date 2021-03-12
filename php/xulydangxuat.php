<?php
	require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$lichsu= new nguoidung_log();
	$ngaygio=date('Y-m-d H:i:s');
	$data=array(
	                'ID',
	                'TAIKHOAN' => $_SESSION['taikhoan'],
	                'SUKIEN' => 'Đăng xuất',
	                'NGAYGIO' => $ngaygio 
	            );
	$lichsu->insert_nguoidung_log($data);
    session_destroy();
    header('location:../login.php');
?>