<?php
    session_start();
	require ("../../BackEnd/DB_driver.php");
    require ("../../BackEnd/DB_business.php");
    require ("../../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $nguoidung= new nguoidung();
    if(isset($_POST['save']))
    {
    	$taikhoan = $_POST['taikhoan'];
        $matkhau =md5($_POST['new_password']);
        $anh;
        $tennguoidung = $_POST['tennguoidung'];
        $quyenhan = $_POST['quyenhan'];
        //trường hợp chọn ảnh
        if(isset($_FILES['anhvs']) && $_FILES['anhvs']["name"]!=null)
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
                echo "<div class='text-center mt-3'>";
                echo "<h5  class='text-danger'>Chỉ cho phép định dạng JPG, JPEG hoặc PNG!</h5><br>";
                echo "<a  href=../themmoinguoidung.php>Quay lại</a>";
                echo "</div>";
            }
            else if($file_size > 4194304){
                $errors[] = 'Chỉ cho phép upload file có kích thước < 4 MB';
            }else
            if(empty($errors)===true)
            {
                $anh = $file_name;
                $ds1 = $nguoidung->check_nguoidung($taikhoan);
                if($ds1>0)
                {
                    header('location: ../themmoinguoidung.php');
                    $err="Mã đã tồn tại, vui lòng nhập lại";
                    $_SESSION['tt']=$err;
                }else
                if($ds1<=0)
                {
                    $data= array(
                        'TAIKHOAN'  => $taikhoan,
                        'MATKHAU' => $matkhau,
                        'TENNGUOIDUNG' => $tennguoidung,
                        'MUCDO' => $quyenhan,
                        'ANH' => $anh,
                    );
                    move_uploaded_file($file_tmp,"../images/".$file_name);
                    $nguoidung->insert_nguoidung($data);
                    header('location: ../themmoinguoidung.php');
                    $sucss="Thêm người dùng thành công";
                    $_SESSION['tt']=$sucss;
                }
            }
        }else
        //trường hợp không chọn ảnh
        if(isset($_FILES['anhvs']) && $_FILES['anhvs']["name"]==null)
        {
            $anh = "logo.jpg";
            $ds2 = $nguoidung->check_nguoidung($taikhoan);
            if($ds2>0)
            {
                header('location: ../themmoinguoidung.php');
                $err="Mã đã tồn tại, vui lòng nhập lại";
                $_SESSION['tt']=$err;
            }else
            if($ds2<=0)
            {
                $data2= array(
                        'TAIKHOAN'  => $taikhoan,
                        'MATKHAU' => $matkhau,
                        'TENNGUOIDUNG' => $tennguoidung,
                        'MUCDO' => $quyenhan,
                        'ANH' => $anh,
                );
                $nguoidung->insert_nguoidung($data2);
                header('location: ../themmoinguoidung.php');
                $sucss="Thêm người dùng thành công";
                $_SESSION['tt']=$sucss;
            }
        }
    }
    $db->dis_connect();
?>