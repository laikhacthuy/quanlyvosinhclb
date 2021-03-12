<?php
	session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $mavs=$_GET['mavs'];
    $check=$_GET['check'];
    $makhoanthu=$_GET['makhoanthu'];
    $makhoahoc=$_GET['makhoahoc'];
    $tinhtrang="2";
    $ngaydong = date('Y-m-d');
    $vosinh= new vosinh();
    $danhsachdong = new danhsachdong();

    $lichsu= new nguoidung_log();
    $ngaygio=date('Y-m-d H:i:s');
    $data2=array(
                    'ID',
                    'TAIKHOAN' => $_SESSION['taikhoan'],
                    'SUKIEN' => 'Cập nhật danh sách đóng',
                    'NGAYGIO' => $ngaygio 
                );
    if($check=='2')
    {
        if (isset($_POST['capnhat'])) 
        {
            $sodumoi=$_POST['sodu'];
            $dskhoanthu=$_SESSION['makhoanthu'];
            foreach ($dskhoanthu as $value) {
                $data = array(
                    "MAVS" => $mavs,
                    "MAKHOANTHU" => $value,
                    "TINHTRANG" => $tinhtrang,
                    "NGAYDONG" => $ngaydong,
                );
                $danhsachdong->capnhat_danhsachdong($data,$value,$mavs);
            }
            $data2 = array(
                    "SODU" => $sodumoi,
            );
            $vosinh->update_vosinh($data2,$mavs);
            $lichsu->insert_nguoidung_log($data2);
            unset($_SESSION['makhoanthu']);
            echo '<script> alert("Đóng tiền thành công");
                    window.location="http://localhost/quanlylopvo/hocphi.php";
                </script>'; 
           
        }
    }else
    if($check=='1')
    {
        if (isset($_POST['capnhat'])) 
        {
            $sodumoi=$_POST['sodu'];
            $dskhoanthu=$_SESSION['makhoanthu'];
            foreach ($dskhoanthu as $value) {
                $data = array(
                    "MAVS" => $mavs,
                    "MAKHOANTHU" => $value,
                    "TINHTRANG" => $tinhtrang,
                    "NGAYDONG" => $ngaydong,
                );
                $danhsachdong->capnhat_danhsachdong($data,$value,$mavs);
            }
            $data2 = array(
                    "SODU" => $sodumoi,
            );
            $vosinh->update_vosinh($data2,$mavs);
            $lichsu->insert_nguoidung_log($data2);
            unset($_SESSION['makhoanthu']);
            echo '<script> alert("Đóng tiền thành công");
                    window.location="http://localhost/quanlylopvo/hocphiloc.php?makhoanthu='.$makhoanthu.'&makhoahoc='.$makhoahoc.'";
                </script>';
        } 
    }
    

?>