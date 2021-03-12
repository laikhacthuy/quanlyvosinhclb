<?php
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $makhoanthu = $_POST['makhoanthu'];
    $makhoahoc= $_POST['makhoahoc'];
    if (isset($_POST['boloc'])) {
    	if ($makhoanthu!=null && $makhoahoc!=null) 
    	{
    		header("location:../danhsachdongtienloc.php?makhoanthu=".$makhoanthu."&makhoahoc=".$makhoahoc." ");
    	} else
    	if ($makhoanthu!=null && $makhoahoc==null)
    	{
    		header("location:../danhsachdongtienloc.php?makhoanthu=".$makhoanthu."&makhoahoc=".$makhoahoc." ");
    	}else
    	if ($makhoanthu==null && $makhoahoc!=null)
    	{
    		header("location:../danhsachdongtienloc.php?makhoanthu=".$makhoanthu."&makhoahoc=".$makhoahoc." ");
    	}else
    	if ($makhoanthu==null && $makhoahoc==null)
    	{
    		echo "Vui lòng chọn điều kiện lọc";
			echo "<br>";
			echo "<a  href=../danhsachdongtien.php>Quay lại</a>";
    	}
    	
    }   
?>