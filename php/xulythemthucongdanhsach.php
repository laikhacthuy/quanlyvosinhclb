<?php
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $danhsachdong = new danhsachdong();
    $lichsu= new nguoidung_log();
	$ngaygio=date('Y-m-d H:i:s');
	$data2=array(
	                'ID',
	                'TAIKHOAN' => $_SESSION['taikhoan'],
	                'SUKIEN' => 'Thêm ủng hộ',
	                'NGAYGIO' => $ngaygio 
	            );
    if(isset($_POST['luu']))
    {
    	$mavs = $_POST['mavosinh'];
		$makhoanthu = $_POST['makhoanthu'];
		$tinhtrang =1;
		$check=$danhsachdong->check_danhsachdong($makhoanthu,$mavs);
		if($check!=null)
		{
			header('location: ../themmoidanhsachdongtien.php');
            $loi="Danh sách đóng tiền đã tồn tại";
            $_SESSION['thongbao']=$loi;
		}else{
			$data = array(
				"MAVS" => $mavs,
				"MAKHOANTHU" => $makhoanthu,
				"TINHTRANG" => $tinhtrang,
				"NGAYDONG"
			);
			$lichsu->insert_nguoidung_log($data2);
			$danhsachdong->insert_danhsachdong($data);
			header('location: ../themmoidanhsachdongtien.php');
            $thanhcong="Thêm thủ công thành công";
            $_SESSION['thongbao']=$thanhcong;
		}
		
    }

?>