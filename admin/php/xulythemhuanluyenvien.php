<?php
	session_start();
	require ("../../BackEnd/DB_driver.php");
    require ("../../BackEnd/DB_business.php");
    require ("../../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $huanluyenvien= new huanluyenvien();
    if(isset($_POST['save']))
    {
    	$mahlv = $_POST['mahlv'];
		$tenhlv = $_POST['tenhlv'];
		$ngaysinh = $_POST['ngaysinh'];
		$diachi = $_POST['diachi'];
		$dienthoai = $_POST['dienthoai'];
		$maudai = $_POST['maudai'];
		$ngayvaoday = $_POST['ngayvaoday'];
		$anh;
		$tinhtrang = $_POST['tinhtrang'];
		//trường hợp chọn ảnh
		if(isset($_FILES['anhhlv']) && $_FILES['anhhlv']["name"]!=null)
		{
			$errors= array();
			$file_name = $_FILES['anhhlv']['name'];
			$file_size = $_FILES['anhhlv']['size'];
			$file_tmp = $_FILES['anhhlv']['tmp_name'];
			$file_type = $_FILES['anhhlv']['type'];
			$arr = explode('.',$file_name);
			$file_ext = strtolower(end($arr));
			$expensions = array("jpeg","jpg","png");

			if(in_array($file_ext,$expensions) === false)
			{
				$errors[]="Chỉ cho phép định dạng JPG, JPEG hoặc PNG.";
				echo "<div class='text-center mt-3'>";
				echo "<h5  class='text-danger'>Chỉ cho phép định dạng JPG, JPEG hoặc PNG!</h5><br>";
				echo "<a  href=../themmoihuanluyenvien.php>Quay lại</a>";
				echo "</div>";
			}
			else if($file_size > 4194304){
				$errors[] = 'Chỉ cho phép upload file có kích thước < 4 MB';
			}else
			if(empty($errors)===true)
			{
				$anh = $file_name;
				$ds1 = $huanluyenvien->check_hlv($mahlv);
		    	if($ds1!=null)
		    	{
		    		header('location: ../themmoihuanluyenvien.php');
		    		$loi="Mã đã tồn tại, vui lòng nhập lại";
		    		$_SESSION['thongbao']=$loi;
		    	}else
		    	if($ds1==null)
		    	{
		    		$hlv= array(
					    'MAHLV'  => $mahlv,
					    'TENHLV' => $tenhlv,
					    'NGAYSINH' => $ngaysinh,
					    'SDT' => $dienthoai,
					    'DIACHI' => $diachi,
					    'MAUDAI' => $maudai,
					    'NGAYVAO' => $ngayvaoday,
					    'TINHTRANG' => $tinhtrang,
					    'ANH' => $anh,  
					);
					move_uploaded_file($file_tmp,"../images/".$file_name);
					$huanluyenvien->insert_hlv($hlv);
					header('location: ../themmoihuanluyenvien.php');
					$thanhcong="Thêm huấn luyện viên thành công";
	    			$_SESSION['thongbao']=$thanhcong;
		    	}
			}
		}else
		//trường hợp không chọn ảnh
		if(isset($_FILES['anhhlv']) && $_FILES['anhhlv']["name"]==null)
		{
			$anh = "logo.jpg";
			$ds2 = $huanluyenvien->check_hlv($mahlv);
	    	if($ds2>0)
	    	{
	    		header('location: ../themmoihuanluyenvien.php');
	    		$loi="Mã đã tồn tại, vui lòng nhập lại";
	    		$_SESSION['thongbao']=$loi;
	    	}else
	    	if($ds2<=0)
	    	{
	    		$hlv2= array(
					    'MAHLV'  => $mahlv,
					    'TENHLV' => $tenhlv,
					    'NGAYSINH' => $ngaysinh,
					    'SDT' => $dienthoai,
					    'DIACHI' => $diachi,
					    'MAUDAI' => $maudai,
					    'NGAYVAO' => $ngayvaoday,
					    'TINHTRANG' => $tinhtrang,
					    'ANH' => $anh,  
				);
				$huanluyenvien->insert_hlv($hlv2);
				header('location: ../themmoihuanluyenvien.php');
				$thanhcong="Thêm huấn luyện viên thành công";
	    		$_SESSION['thongbao']=$thanhcong;
	    	}
		}
    }
    $db->dis_connect();
?>