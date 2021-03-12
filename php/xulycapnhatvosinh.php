<?php
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $vosinh = new vosinh();
    $thongtinvosinh = new thongtinvosinh();
    $lichsu= new nguoidung_log();
	$ngaygio=date('Y-m-d H:i:s');
	$data=array(
	                'ID',
	                'TAIKHOAN' => $_SESSION['taikhoan'],
	                'SUKIEN' => 'Cập nhật võ sinh',
	                'NGAYGIO' => $ngaygio 
	            );
    if(isset($_POST['capnhat']))
    {
    	$mavs = $_POST['mavs'];
		$tenvs = $_POST['tenvs'];
		$ngaysinh = $_POST['ngaysinh'];
		$diachi = $_POST['diachi'];
		$gioitinh = $_POST['gioitinh'];
		$makh = $_POST['khoahoc'];
		$dienthoai = $_POST['dienthoai'];
		$mamaudai = $_POST['maudai'];
		$ghichu = $_POST['ghichu'];
		$tenph = $_POST['tenph'];
		$sdtph = $_POST['sdtph'];
		$ngaynhaphoc = $_POST['ngaynhaphoc'];
		$ngaythidai =$ngaynhaphoc ;
		$anh;
		$sodu = $_POST['sodu'];
		$tinhtrang = $_POST['tinhtrang'];
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
				echo "<a  href=../capnhatvosinh_chitiet.php?mavs='".$mavs."'>Quay lại</a>";
				echo "</div>";
			}
			else if($file_size > 4194304){
				$errors[] = 'Chỉ cho phép upload file có kích thước < 4 MB';
			}else
			if(empty($errors)===true)
			{
				$anh = $file_name;
	    		$vs= array(
				    'MAVS'  => $mavs,
				    'TENVS' => $tenvs,
				    'GIOITINH' => $gioitinh,
				    'NGAYSINH' => $ngaysinh,
				    'DIENTHOAI' => $dienthoai,
				    'NGAYTHIDAI' => $ngaythidai,
				    'MAMAUDAI' => $mamaudai,
				    'TINHTRANG' => $tinhtrang,
				    'SODU' => $sodu,
				    'MAKH' => $makh,  
				);
				$ttvs= array(
				    'MAVS'  => $mavs,
				    'TENPHUHUYNH' => $tenph,
				    'DIENTHOAIPH' => $sdtph,
				    'DIACHI' => $diachi,
				    'NGAYNHAPHOC' => $ngaynhaphoc,
				    'ANH' => $anh,
				    'GHICHU' => $ghichu,
				);
				move_uploaded_file($file_tmp,"../images/".$file_name);
				$vosinh->update_vosinh($vs,$mavs);
				$thongtinvosinh->update_thongtinvosinh($ttvs,$mavs);
				$lichsu->insert_nguoidung_log($data);
				header("location:../capnhatvosinh_chitiet.php?mavs=".$mavs."");
        		$thanhcong="Cập nhật thành công";
        		$_SESSION['thongbao']=$thanhcong;
		    }
		}
		else
		//trường hợp không chọn ảnh
		if(isset($_FILES['anhvs']) && $_FILES['anhvs']["name"]==null)
		{
	    		$vska= array(
					    'MAVS'  => $mavs,
					    'TENVS' => $tenvs,
					    'GIOITINH' => $gioitinh,
					    'NGAYSINH' => $ngaysinh,
					    'DIENTHOAI' => $dienthoai,
					    'NGAYTHIDAI' => $ngaythidai,
					    'MAMAUDAI' => $mamaudai,
					    'TINHTRANG' => $tinhtrang,
					    'SODU' => $sodu,
					    'MAKH' => $makh,  
				);
				$ttvska= array(
					    'MAVS'  => $mavs,
					    'TENPHUHUYNH' => $tenph,
					    'DIENTHOAIPH' => $sdtph,
					    'DIACHI' => $diachi,
					    'NGAYNHAPHOC' => $ngaynhaphoc,
					    'GHICHU' => $ghichu,
				);
				$vosinh->update_vosinh($vska,$mavs);
				$thongtinvosinh->update_thongtinvosinh($ttvska,$mavs);
				$lichsu->insert_nguoidung_log($data);
				header("location:../capnhatvosinh_chitiet.php?mavs=".$mavs."");
        		$thanhcong="Cập nhật thành công";
        		$_SESSION['thongbao']=$thanhcong;
	    }
    }
    $db->dis_connect();
?>