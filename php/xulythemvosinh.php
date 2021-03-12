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
	                'SUKIEN' => 'Thêm võ sinh',
	                'NGAYGIO' => $ngaygio 
	            );
    if(isset($_POST['save']))
    {
    	$mavs = $_POST['mavosinh'];
		$tenvs = $_POST['tenvosinh'];
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
				echo "<a  href=../themmoivosinh.php>Quay lại</a>";
				echo "</div>";
			}
			else if($file_size > 4194304){
				$errors[] = 'Chỉ cho phép upload file có kích thước < 4 MB';
			}else
			if(empty($errors)===true)
			{
				$anh = $file_name;
				$ds1 = $vosinh->check_mavs($mavs);
		    	if($ds1!=null)
		    	{
		    		header('location: ../themmoivosinh.php');
		    		$loi="Mã võ sinh đã tồn tại, vui lòng nhập lại";
		    		$_SESSION['thongbao']=$loi;
		    	}else
		    	if($ds1==null)
		    	{
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
					$vosinh->insert_vosinh($vs);
					$thongtinvosinh->insert_thongtinvosinh($ttvs);
					$lichsu->insert_nguoidung_log($data);
					header('location: ../themmoivosinh.php');
					$thanhcong="Thêm võ sinh thành công";
	    			$_SESSION['thongbao']=$thanhcong;
		    	}
			}
		}else
		//trường hợp không chọn ảnh
		if(isset($_FILES['anhvs']) && $_FILES['anhvs']["name"]==null)
		{
			$anh = "logo.jpg";
			$ds2 = $vosinh->check_mavs($mavs);
	    	if($ds2>0)
	    	{
	    		header('location: ../themmoivosinh.php');
	    		$loi="Mã võ sinh đã tồn tại, vui lòng nhập lại";
	    		$_SESSION['thongbao']=$loi;
	    	}else
	    	if($ds2<=0)
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
					    'ANH' => $anh,
					    'GHICHU' => $ghichu,
				);
				$vosinh->insert_vosinh($vska);
				$thongtinvosinh->insert_thongtinvosinh($ttvska);
				$lichsu->insert_nguoidung_log($data);
				header('location: ../themmoivosinh.php');
				$thanhcong="Thêm võ sinh thành công";
	    		$_SESSION['thongbao']=$thanhcong;
	    	}
		}
    }
    $db->dis_connect();
?>