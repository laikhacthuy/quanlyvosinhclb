<?php
	session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $username=$_POST['taikhoan'];
    $pass=$_POST['matkhau'];
    
    // Sau khi dang nhap
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_classes.php");

    $db = new DB_driver();
    $db->connect();
    $lichsu= new nguoidung_log();
    $ngaygio=date('Y-m-d H:i:s');
    $taikhoan = mysqli_escape_string($db->__conn, $username);
    $matkhau = mysqli_escape_string($db->__conn, md5($pass));

    // mysqli_set_charset($connSanPham,"utf8");
    $sql = "SELECT TAIKHOAN,MATKHAU,TENNGUOIDUNG,MUCDO,ANH FROM nguoidung WHERE TAIKHOAN = '$taikhoan' AND MATKHAU='$matkhau'";
    $ds = $db->get_row($sql);
    if($ds>0)
    {
        $_SESSION['taikhoan'] = $ds['TAIKHOAN'];
        $_SESSION['mucdo'] = $ds['MUCDO'];
        $_SESSION['tennguoidung'] = $ds['TENNGUOIDUNG'];
        $_SESSION['anh'] = $ds['ANH'];
        $data=array(
                'ID',
                'TAIKHOAN' => $_SESSION['taikhoan'],
                'SUKIEN' => 'Đăng nhập',
                'NGAYGIO' => $ngaygio 
            );
        if($ds['MUCDO']==1||$ds['MUCDO']==2){
        	header('location: ../home.php');
            $lichsu->insert_nguoidung_log($data);
        }else
		if($ds['MUCDO']==0)
        {
        	header('location: ../admin/index.php');
            $lichsu->insert_nguoidung_log($data);
        }
        else
		if($ds['MUCDO']==3)
        {
        	header('location: ../vosinh/index.php');
        } 
    }
    else
    if($ds<=0)
    {
        header('location: ../login.php');
     	$error="Tài khoản hoặc mật khẩu không chính xác, vui lòng nhập lại";
        $_SESSION['error'] = $error; 
    }
    $db->dis_connect();
?>