<?php
    session_start();
    if(isset($_SESSION['makhoanthu_ds']))
    {
        unset($_SESSION['makhoanthu_ds']);
        unset($_SESSION['xoads']);
        header('location:../themmoidanhsachdongtien.php');
    }
?>