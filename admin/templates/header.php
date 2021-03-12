<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TRANG QUẢN TRỊ</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/fonts/font-awesome.min.css">
    <script src="js/libs/jquery-1.9.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header d-flex">
                <img src="../images/logo2.gif" class="img_logo rounded-circle">
                <h3 class="text-center headmenu">Menu</h3>
            </div>
            <?php
            session_start();
            if(isset($_SESSION['mucdo']))
        {
            $quyenhan=$_SESSION['mucdo'];
            if($quyenhan==0)
            {
            echo'
            <ul class="list-unstyled components">
                <li>
                    <a href="index.php"><i class="fa fa-credit-card"></i> DASHBOARD</a>
                </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user"></i> NGƯỜI DÙNG</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li >
                            <a href="themmoinguoidung.php">Thêm mới người dùng</a>
                        </li>
                        <li >
                            <a href="danhsachnguoidung.php">Danh sách người dùng</a>
                        </li>
                        <li >
                            <a href="lichsunguoidung.php">Lịch sử người dùng</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="#bankSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-bank"></i> HUẤN LUYỆN VIÊN</a>
                    <ul class="collapse list-unstyled" id="bankSubmenu">
                        <li>
                            <a href="themmoihuanluyenvien.php">Tạo mới huấn luyện viên</a>
                        </li>
                        <li>
                            <a href="danhsachhlv.php">Danh sách huấn luyện viên</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-list"></i> KHOẢN THU </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li >
                            <a href="themmoikhoanthu.php">Tạo mới khoản thu</a>
                        </li>
                        <li >
                            <a href="danhsachkhoanthu.php">Danh sách khoản thu</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#yearSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-bookmark-o"></i> KHOÁ HỌC</a>
                    <ul class="collapse list-unstyled" id="yearSubmenu">
                        <li >
                            <a href="themmoikhoahoc.php">Tạo mới khoá học</a>
                        </li>
                        <li >
                            <a href="danhsachkhoahoc.php">Danh sách khóa học</a>
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
            </ul>';
            }
        }else{
             header('location:../login.php');
        }
            ?>
        </nav>
        <div id="content">
            <?php
                if(isset($_SESSION['tennguoidung']))
                {
                    $tennguoidung=$_SESSION['tennguoidung'];
                    echo'
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
                                            <a class="nav-link" href="../php/xulydangxuat.php"><i class="fa  fa-power-off"></i> Thoát</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>';
                }else{
                    header('location:../login.php');
                }
            ?>
