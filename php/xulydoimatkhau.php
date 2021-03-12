<?php
	session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $nguoidung = new nguoidung();
    $lichsu= new nguoidung_log();
    $ngaygio=date('Y-m-d H:i:s');
    $data2=array(
                    'ID',
                    'TAIKHOAN' => $_SESSION['taikhoan'],
                    'SUKIEN' => 'Đổi mật khẩu',
                    'NGAYGIO' => $ngaygio 
                );
    $taikhoan=$_SESSION['taikhoan'];
    if (isset($_POST['save'])) 
    {
    	$matkhau=md5($_POST['matkhaumoi']);
		$data = array(
			"MATKHAU" => $matkhau,
		);
		$nguoidung->capnhat_nguoidung($data,$taikhoan);
        $lichsu->insert_nguoidung_log($data2);
		echo "Cập nhật thành công";
		echo "<br>";
		echo "<a  href=../login.php>Đăng nhập lại</a>";
    }

?>