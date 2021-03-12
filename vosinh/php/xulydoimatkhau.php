<?php
	session_start();
    require ("../../BackEnd/DB_driver.php");
    require ("../../BackEnd/DB_business.php");
    require ("../../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $nguoidung = new nguoidung();
    $taikhoan=$_SESSION['taikhoan'];
    if (isset($_POST['save'])) 
    {
    	$matkhau=md5($_POST['matkhaumoi']);
		$data = array(
			"MATKHAU" => $matkhau,
		);
		$nguoidung->capnhat_nguoidung($data,$taikhoan);
		echo "Cập nhật thành công";
		echo "<br>";
		echo "<a  href=../../login.php>Đăng nhập lại</a>";
    }

?>