<?php
    session_start();
	require ("../../BackEnd/DB_driver.php");
    require ("../../BackEnd/DB_business.php");
    require ("../../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $nguoidung= new nguoidung();
    if(isset($_POST['capnhat']))
    {
    	$taikhoan = $_POST['taikhoan'];
        $matkhau=$_POST['matkhau'];
        $anh;
        $tennguoidung = $_POST['tennguoidung'];
        $quyenhan = $_POST['quyenhan'];
        //trường hợp chọn ảnh và thay đổi mật khẩu
        if(isset($_FILES['anhvs']) && $_FILES['anhvs']["name"]!=null && $matkhau!=null)
        {
            $errors= array();
            $file_name = $_FILES['anhvs']['name'];
            $file_size = $_FILES['anhvs']['size'];
            $file_tmp = $_FILES['anhvs']['tmp_name'];
            $file_type = $_FILES['anhvs']['type'];
            $arr = explode('.',$file_name);
            $file_ext = strtolower(end($arr));
            $expensions = array("jpeg","jpg","png");

            if(in_array($file_ext,$expensions) === false)
            {
                $errors[]="Chỉ cho phép định dạng JPG, JPEG hoặc PNG.";
                echo '<div class="text-center mt-3">
                 <h5  class="text-danger">Chỉ cho phép định dạng JPG, JPEG hoặc PNG!</h5><br>
                 <a  href="../capnhatnguoidung.php?taikhoan='.$taikhoan.'">Quay lại</a>
                 </div>';
            }
            else if($file_size > 4194304){
                $errors[] = 'Chỉ cho phép upload file có kích thước < 4 MB';
            }else
            if(empty($errors)===true)
            {
                $anh = $file_name;
                $matkhau =md5($_POST['matkhau']);
                $data= array(
                    'TAIKHOAN'  => $taikhoan,
                    'MATKHAU' => $matkhau,
                    'TENNGUOIDUNG' => $tennguoidung,
                    'MUCDO' => $quyenhan,
                    'ANH' => $anh,
                );
                move_uploaded_file($file_tmp,"../images/".$file_name);
                $nguoidung->capnhat_nguoidung($data,$taikhoan);
                header('location:../capnhatnguoidung.php?taikhoan='.$taikhoan.'');
                $sucss="Cập nhật thành công";
                $_SESSION['tt']=$sucss;
            }
        }else
        //trường họp chọn ảnh và không thay đổi mật khẩu
        if(isset($_FILES['anhvs']) && $_FILES['anhvs']["name"]!=null && $matkhau==null)
        {
            $errors= array();
            $file_name = $_FILES['anhvs']['name'];
            $file_size = $_FILES['anhvs']['size'];
            $file_tmp = $_FILES['anhvs']['tmp_name'];
            $file_type = $_FILES['anhvs']['type'];
            $arr = explode('.',$file_name);
            $file_ext = strtolower(end($arr));
            $expensions = array("jpeg","jpg","png");

            if(in_array($file_ext,$expensions) === false)
            {
                $errors[]="Chỉ cho phép định dạng JPG, JPEG hoặc PNG.";
                echo '<div class="text-center mt-3">
                 <h5  class="text-danger">Chỉ cho phép định dạng JPG, JPEG hoặc PNG!</h5><br>
                 <a  href="../capnhatnguoidung.php?taikhoan='.$taikhoan.'">Quay lại</a>
                 </div>';
            }
            else if($file_size > 4194304){
                $errors[] = 'Chỉ cho phép upload file có kích thước < 4 MB';
            }else
            if(empty($errors)===true)
            {
                $anh = $file_name;
                $data2= array(
                    'TAIKHOAN'  => $taikhoan,
                    'TENNGUOIDUNG' => $tennguoidung,
                    'MUCDO' => $quyenhan,
                    'ANH' => $anh,
                );
                move_uploaded_file($file_tmp,"../images/".$file_name);
                $nguoidung->capnhat_nguoidung($data2,$taikhoan);
                header('location:../capnhatnguoidung.php?taikhoan='.$taikhoan.'');
                $sucss="Cập nhật thành công";
                $_SESSION['tt']=$sucss;
            }
        }else
        //trường hợp không chọn ảnh và thay đổi mật khẩu
        if(isset($_FILES['anhvs']) && $_FILES['anhvs']["name"]==null && $matkhau!=null)
        {
            $matkhau =md5($_POST['matkhau']);
            $data3= array(
                    'TAIKHOAN'  => $taikhoan,
                    'MATKHAU' => $matkhau,
                    'TENNGUOIDUNG' => $tennguoidung,
                    'MUCDO' => $quyenhan,
            );
            $nguoidung->capnhat_nguoidung($data3,$taikhoan);
            header('location:../capnhatnguoidung.php?taikhoan='.$taikhoan.'');
            $sucss="Cập nhật thành công";
            $_SESSION['tt']=$sucss;
        }else
        //trường hợp không chọn ảnh và không thay đổi mật khẩu
        if(isset($_FILES['anhvs']) && $_FILES['anhvs']["name"]==null && $matkhau==null)
        {
            $data4= array(
                    'TAIKHOAN'  => $taikhoan,
                    'TENNGUOIDUNG' => $tennguoidung,
                    'MUCDO' => $quyenhan,
            );
            $nguoidung->capnhat_nguoidung($data4,$taikhoan);
            header('location:../capnhatnguoidung.php?taikhoan='.$taikhoan.'');
            $sucss="Cập nhật thành công";
            $_SESSION['tt']=$sucss;
        }
    }
    $db->dis_connect();
?>