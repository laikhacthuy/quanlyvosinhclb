<?php
    session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $vosinh = new vosinh();
    $danhsachdong = new danhsachdong();
    $dsvs = $vosinh->list_mavosinh();
    $lichsu= new nguoidung_log();
    $ngaygio=date('Y-m-d H:i:s');
    $data2=array(
                    'ID',
                    'TAIKHOAN' => $_SESSION['taikhoan'],
                    'SUKIEN' => 'Thêm danh sách đóng tiền',
                    'NGAYGIO' => $ngaygio 
                );
    $makhoanthu=$_POST['makhoanthu'];
    
    $dsdong;
    $mavs;
    $tinhtrang='1';
    if(isset($_POST['save']))
    {
        foreach ($dsvs as $key => $value) {
            $mavs=$value['MAVS'];
            $dsdong = $danhsachdong->check_danhsachdongbyid($makhoanthu,$value['MAVS']);
        }
        if($dsdong!=null)
        {
            header('location: ../themmoidanhsachdongtien.php');
            $loi="Danh sách đóng tiền đã tồn tại";
            $_SESSION['thongbao']=$loi;
        }else
        {
            foreach ($dsvs as $key => $value) 
            {
                $dsdong = $danhsachdong->check_danhsachdongbyid($makhoanthu,$value['MAVS']);
                $mavs=$value['MAVS'];
                $data = array(
                    "MAVS"=>$mavs,
                    "MAKHOANTHU"=>$makhoanthu,
                    "TINHTRANG"=>$tinhtrang,
                    "NGAYDONG",
                );
                $danhsachdong->insert_danhsachdong($data);
            }
            $lichsu->insert_nguoidung_log($data2);
            $_SESSION['makhoanthu_ds']=$makhoanthu;
            header('location: ../themmoidanhsachdongtien.php');
            $thanhcong="Danh sách đóng tiền tạo thành công";
            $_SESSION['thongbao']=$thanhcong;
        }  
    }
?>