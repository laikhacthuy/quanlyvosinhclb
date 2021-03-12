<?php
    session_start();
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $ungho = new ungho();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $lichsu= new nguoidung_log();
    $ngaygio=date('Y-m-d H:i:s');
    $data=array(
                    'ID',
                    'TAIKHOAN' => $_SESSION['taikhoan'],
                    'SUKIEN' => 'Xóa ủng hộ',
                    'NGAYGIO' => $ngaygio 
                );
    $lichsu->insert_nguoidung_log($data);

    $id=$_GET['id'];
    $ungho->xoa_ungho($id);
	header("location:../danhsachungho.php");

?>