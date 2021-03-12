<?php
    session_start();
    require ("../BackEnd/DB_driver.php");
    require ("../BackEnd/DB_business.php");
    require ("../BackEnd/DB_classes.php");
    $db = new DB_driver();
    $db->connect();
    $danhsachdong = new danhsachdong();
    if(isset($_POST['boloc']))
    {   
      $makhoanthu=$_POST['makhoanthu'];
      $makhoahoc=$_POST['makhoahoc'];
      if($makhoanthu==null&&$makhoahoc==null)
      {
        header('location:../hocphi.php');
        $loi="Vui lòng chọn điều kiện lọc";
        $_SESSION['thongbao']=$loi;
      }else
      if($makhoanthu!=null&&$makhoahoc!=null)
      {
        header("location:../hocphiloc.php?makhoanthu=".$makhoanthu."&makhoahoc=".$makhoahoc." ");
      }else
      if($makhoanthu!=null&&$makhoahoc==null)
      {
        header("location:../hocphiloc.php?makhoanthu=".$makhoanthu."&makhoahoc=".$makhoahoc." ");
      }else
      if($makhoanthu==null&&$makhoahoc!=null)
      {
        header("location:../hocphiloc.php?makhoanthu=".$makhoanthu."&makhoahoc=".$makhoahoc." ");
      }      
    }
?>