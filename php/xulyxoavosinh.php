<?php
    session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $vosinh = new vosinh();
    $thongtinvosinh= new thongtinvosinh();
    $lichsu= new nguoidung_log();
    $ngaygio=date('Y-m-d H:i:s');
    $data=array(
                    'ID',
                    'TAIKHOAN' => $_SESSION['taikhoan'],
                    'SUKIEN' => 'Xóa võ sinh',
                    'NGAYGIO' => $ngaygio 
                );
    $lichsu->insert_nguoidung_log($data);
    $mavs=$_GET['mavs'];
    $thongtinvosinh->xoa_thongtinvosinh($mavs);
    $vosinh->xoa_vosinh($mavs);
    header("location:".$_SESSION['url']."");

?>