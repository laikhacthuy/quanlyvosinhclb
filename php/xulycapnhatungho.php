<?php
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $id=$_GET['id'];
    $ungho = new ungho();
    $lichsu= new nguoidung_log();
	$ngaygio=date('Y-m-d H:i:s');
	$data2=array(
	                'ID',
	                'TAIKHOAN' => $_SESSION['taikhoan'],
	                'SUKIEN' => 'Cập nhật ủng hộ',
	                'NGAYGIO' => $ngaygio 
	            );
    if (isset($_POST['capnhat'])) 
    {
    	$tenungho = $_POST['tenungho'];
		$sdt = $_POST['sdt'];
		$ngaydong = $_POST['ngaydong'];
		$tienungho = $_POST['tienungho'];
		$ghichu = $_POST['ghichu'];

		$data = array(
			"TENNGUOIUNGHO" => $tenungho,
			"NGAYDONG" => $ngaydong,
			"SOTIENDONG" => $tienungho,
			"SDT" => $sdt,
			"GHICHU" => $ghichu,
		);
		$ungho->capnhat_ungho($data,$id);
		$lichsu->insert_nguoidung_log($data2);
		header('location: ../capnhatungho_chitiet.php?id='.$id.'');
		$thanhcong="Cập nhật thành công";
		$_SESSION['thongbao']=$thanhcong;
    }

?>