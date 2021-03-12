<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>KARATE-DO VẠN XUÂN</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fonts/font-awesome.min.css">
    <script src="js/libs/jquery-1.9.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
    <script src="js/alertify.js"></script>
    <script src="js/alertify.min.js"></script>
    <link rel="stylesheet" href="js/themes/alertify.bootstrap.css">
    <link rel="stylesheet" href="js/themes/alertify.default.css">
    <link rel="stylesheet" href="js/themes/alertify.core.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header d-flex">
                <img src="images/logo2.gif" class="img_logo rounded-circle">
                <h3 class="text-center headmenu">Menu</h3>
            </div>
<?php
            session_start();
            $quyenhan=$_SESSION['mucdo'];
            $tennguoidung=$_SESSION['tennguoidung'];
            if($quyenhan==1)
            {
            echo'
            <ul class="list-unstyled components">
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user"></i> VÕ SINH</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li >
                            <a href="themmoivosinh.php">Thêm võ sinh mới</a>
                        </li>
                        <li >
                            <a href="danhsachvosinh.php">Danh sách võ sinh</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-list"></i> DANH SÁCH ĐÓNG TIỀN </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li >
                            <a href="themmoidanhsachdongtien.php">Tạo mới danh sách</a>
                        </li>
                        <li >
                            <a href="danhsachdongtien.php">Danh sách đóng tiền</a>
                        </li>
                        <li>
                            <a href="danhsachthilendai.php">Danh sách thi lên đai</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="doimatkhau.php"><i class="fa fa-wrench"></i> ĐỔI MẬT KHẨU</a>
                </li>
            </ul>
                </nav>
            <div id="content">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <div class="col-sm-6  d-flex ">
                        <h4 class="name_club">Câu lạc bộ Karate-do Vạn Xuân</h4>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                               <span class="nav-link text-primary">'.$tennguoidung.'</span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="php/xulydangxuat.php"><i class="fa  fa-power-off"></i> Thoát</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>';
            }else
            if($quyenhan==2)
            {
            echo'
            <ul class="list-unstyled components">
                <li>
                    <a href="hocphi.php"><i class="fa fa-credit-card"></i> HỌC PHÍ</a>
                </li>
                <li>
                    <a href="#bankSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-bank"></i> ỦNG HỘ</a>
                    <ul class="collapse list-unstyled" id="bankSubmenu">
                        <li>
                            <a href="themmoiungho.php">Thêm mới ủng hộ</a>
                        </li>
                        <li>
                            <a href="danhsachungho.php">Danh sách ủng hộ</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#reportSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-bar-chart"></i> BÁO CÁO</a>
                    <ul class="collapse list-unstyled" id="reportSubmenu">
                        <li>
                            <a href="baocaohocphi.php">Báo cáo học phí theo tháng</a>
                        </li>
                        <li>
                            <a href="baocaohocphinhieuthang.php">Báo cáo học phí theo nhiều tháng</a>
                        </li>
                        <li>
                            <a href="baocaoungho.php">Báo cáo ủng hộ</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="doimatkhau.php"><i class="fa fa-wrench"></i> ĐỔI MẬT KHẨU</a>
                </li>
            </ul>
            </nav>
            <div id="content">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <div class="col-sm-6  d-flex ">
                        <h4 class="name_club">Câu lạc bộ Karate-do Vạn Xuân</h4>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                               <span class="nav-link text-primary">'.$tennguoidung.'</span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="php/xulydangxuat.php"><i class="fa  fa-power-off"></i> Thoát</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>';
            }else{
                header('location:login.php');
            }
?>
