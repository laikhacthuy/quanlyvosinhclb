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
    $data=array(
                    'ID',
                    'TAIKHOAN' => $_SESSION['taikhoan'],
                    'SUKIEN' => 'Đăng nhập',
                    'NGAYGIO' => $ngaygio 
                );
    $lichsu->insert_nguoidung_log($data);
    $mavosinh=$_GET['mavosinh'];
    $makhoanthu=$_GET['makhoanthu'];
    $makhoahoc=$_GET['makhoahoc'];
    $danhsachdong->xoa_danhsachdong($makhoanthu,$mavosinh);
    if(isset($_SESSION['xoads'])){
        header('location:'.$_SESSION['xoads'].'');
    }
    else
    {
        if(isset($_SESSION['danhsachdongtien']))
        {
            header('location:'.$_SESSION['danhsachdongtien'].'');
        }
    }
    
?>
