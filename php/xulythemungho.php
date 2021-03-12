<?php
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $ungho = new ungho();
    $lichsu= new nguoidung_log();
	$ngaygio=date('Y-m-d H:i:s');
	$data2=array(
	                'ID',
	                'TAIKHOAN' => $_SESSION['taikhoan'],
	                'SUKIEN' => 'Thêm ủng hộ',
	                'NGAYGIO' => $ngaygio 
	            );
    if(isset($_POST['save']))
    {
    	$tenungho = $_POST['tenungho'];
		$sdt = $_POST['sdt'];
		$ngayungho = $_POST['ngayungho'];
		$tienungho = $_POST['tienungho'];
		$ghichu = $_POST['ghichu'];

		$data = array(
			"ID",
			"TENNGUOIUNGHO" => $tenungho,
			"NGAYDONG" => $ngayungho,
			"SOTIENDONG" => $tienungho,
			"SDT" => $sdt,
			"GHICHU" => $ghichu,
		);
		$ungho->insert_ungho($data);
		$lichsu->insert_nguoidung_log($data2);
		header('location: ../themmoiungho.php');
		$thanhcong="Thêm thành công";
		$_SESSION['thongbao']=$thanhcong;
    }

?>